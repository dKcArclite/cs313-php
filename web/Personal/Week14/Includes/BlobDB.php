<?php

/**
 * BlobDB short summary.
 *
 * BlobDB description.
 *
 * @version 1.0
 * @author rickj
 */
class BlobDB
{
    public function insert($cover) {
        if (!file_exists($cover->pathToFile)) {
            throw new \Exception("File %s not found.");
        }

        $sql = "INSERT INTO cover(book_id,mime_type,file_name,file_data) "
                . "VALUES(:book_id,:mime_type,:file_name,:file_data)";

        try {
            $this->pdo->beginTransaction();

            // create large object
            $fileData = $this->pdo->pgsqlLOBCreate();
            $stream = $this->pdo->pgsqlLOBOpen($fileData, 'w');

            // read data from the file and copy the the stream
            $fh = fopen($cover->pathToFile, 'rb');
            stream_copy_to_stream($fh, $stream);
            //
            $fh = null;
            $stream = null;

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':book_id' => $cover->book_Id,
                ':mime_type' => $cover->mimeType,
                ':file_name' => $cover->fileName,
                ':file_data' => $cover->fileData,
            ]);

            // commit the transaction
            $this->pdo->commit();
        }
        catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }

        return $this->pdo->lastInsertId('cover_id_seq');
    }
}