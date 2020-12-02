#https://redmine.lighttpd.net/projects/lighttpd/wiki/Docs_ModMagnet                                                                                
                                                                                                                                                   
lighty.content = { "<pre>",                                                                                                                      
{ filename = "/etc/passwd" },                                                                                                                      
{ filename = "/var/www/table.lua" },                                                                                                               
"</pre>" }                                                                                                                                         

lighty.header["Content-Type"] = "text/html"                                                                                                      
                                                                                                                                                 
print("Host: " .. lighty.request["Host"])                                                                                                        
print("Request-URI: " .. lighty.env["request.uri"])                                                                                              
                                                                                                                                                   
return 200     

