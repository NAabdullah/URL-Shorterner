# URL-Shorterner

The server is hosted using XAMPP, database uses phpmyadmin

Clone or download the project and place the URL-Shortnerer folder in the C:\xampp\htdocs directory.

1. For access to domain name, please edit the following in the hosts file.

(example filepath: C:\Windows\System32\drivers\etc)

```
127.0.0.1 linkbit.ly
```
2. And edit the following in the httpd-vhosts.conf file

(example filepath: C:\xampp\apache\conf\extra)

```
<VirtualHost *:80>
 ServerName www.linkbit.ly
 ServerAlias linkbit.ly
 DocumentRoot c:/xampp/htdocs/URL-Shorterner
</VirtualHost>
```
3. Import the provided sql file into phpmyadmin

4. Change database user and password if required in DbConnection.php
