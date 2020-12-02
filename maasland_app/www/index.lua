output_contenttype = "text/html" 

cwd = request["CWD"]

output_include = { cwd .. "header.php", 
                   cwd .. "groups.php",
                   cwd .. "footer.php" }

return CACHE_HIT
