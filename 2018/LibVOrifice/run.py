from BaseHTTPServer import BaseHTTPRequestHandler,HTTPServer
import cgi, string, random, shutil, os

class Handler(BaseHTTPRequestHandler):
    def handle_response(self, resp, content_type='text/html', status=200):
        self.send_response(status)
        self.send_header('Content-type', content_type)
        self.end_headers()
        self.wfile.write(resp)                        
    def do_GET(self):
        self.handle_response('<!DOCTYPE html><html><head><title>LibvOrifice</title></head><body><h1>Convert anything to PDF</h1><p>File size limit: 1 KB, running time limit: 30 seconds</p><form method="post" enctype="multipart/form-data"><input name="file" type="file" /><input type="submit" /></form></body></html>')       
    def do_POST(self):
        if int(self.headers['content-length']) > 1024:
            self.handle_response('File too large')
        else:                
            try:
                form = cgi.FieldStorage(
                    fp=self.rfile,
                    headers=self.headers,
                    environ={
                        "REQUEST_METHOD": "POST",
                        "CONTENT_TYPE":   self.headers['Content-Type']
                })
                print form
                print form["file"].file
                z = string.letters + string.digits
                ext = ''.join(x for x in form["file"].filename.split(".")[-1] if x in z)
                if ext == 'pdf':
                    self.handle_response('File is already pdf')
                else:
                    filename = ''.join(random.SystemRandom().choice(z) for _ in range(16))
                    filepath = "/home/libvorifice/"+filename+"."+ext
                    fdoc = open(filepath,"wb")
                    shutil.copyfileobj(form["file"].file, fdoc)
                    fdoc.close()
                    print os.system("timeout 30 libreoffice6.0 --headless --convert-to pdf "+filepath)
                    #os.remove(filepath)
                    fpathpdf = "/home/libvorifice/"+filename+".pdf"
                    try:
                        fpdf = open(fpathpdf, "rb")
                        cpdf = fpdf.read()
                        fpdf.close()
                        os.remove(fpathpdf)
                        self.handle_response(cpdf,"application/pdf")
                    except Exception:
                        self.handle_response('You are unlucky. No output.')                    
            except Exception:
                self.handle_response('??', 'text/plain', 500)
if __name__ == "__main__":
    print "Running..."
    HOST, PORT = "", 64001
    server = HTTPServer((HOST,PORT), Handler)
    while True:
        server.handle_request()