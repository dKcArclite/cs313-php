var http = require('http');
var url = require('url');

function onRequest(request, response) {
    var path = url.parse(request.url).pathname;
    var urlData = url.parse(request.url, true).query;

    switch (path) {
        case "/home":
            response.writeHead(200, { "Content-Type": "text/html" });
            response.write("<h1>Welcome to the Home Page</h1>");
            response.end;
            if (urlData.show=='Rick') {
                response.write('<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?&autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                response.end;
            }              
            break;
        case "/getData":
            var data = "{ 'name': 'Rick Johnson', 'class': 'CS313' }";
            response.writeHead(200, { "Content-Type": "application/json" });
            response.end(JSON.stringify(data));
            response.end;
            break; 
        default:
            response.writeHead(404, { "Content-Type": "text/html" });
            response.write("<h1>Page Not Found</h1>");
            response.end;
            break;
    }
}

http.createServer(onRequest).listen(1337);