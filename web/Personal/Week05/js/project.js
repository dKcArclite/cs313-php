$(document).ready(function() {
    //do not allow non numeric numbers to be entered
    $(".number-only").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
$('#example').dataTable({
				 "bProcessing": true,
                 "sAjaxSource": "List.php",
				 "aoColumns": [
						{ mData: 'Book_Id' } ,
                        { mData: 'Title' },
                        { mData: 'Author' }
						{ mData: 'Genre' }
						{ mData: 'Author' }
						{ mData: 'In_Series' }
						{ mData: 'Series' }
                ]
        });   

});


