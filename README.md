# Installation

```
composer install
yarn install
```
Set database credentials in [.env], encoding database username and password
by urlencode().

Create database schema:
```
bin/console doctrine:schema:create```
```

Validate it:
```
bin/console doctrine:schema:validate
```

Generate some sample data:
```
bin/console hautelook:fixtures:load
```

Unit cases:
```
bin/phpunit
```

# Possible improvements

* Bootstrap Knp menu theme, for now abated, as gist examples not correctly
overriding and extending base template.
* AJAX SPA (Single Page Application) design, possibly using Backbone/Angular.js/Vue
and/or other REST API consumer.

# Appendix

Vhost configuration:

```apacheconf
<VirtualHost *:80>
    ServerAdmin povilas@assault-smg-e565-suppressed
    ServerName localhost.hostinger-print

    # DocumentRoot: The directory out of which you will serve your
    # documents. By default, all requests are taken from this directory, but
    # symbolic links and aliases may be used to point to other locations.
    DocumentRoot /srv/www/vhosts/hostinger-print-sf/public

    # if not specified, the global error log is used
    ErrorLog /var/log/apache2/hostinger-print-error_log
    CustomLog /var/log/apache2/hostinger-print-access_log combined

    # don't loose time with IP address lookups
    HostnameLookups Off

    # needed for named virtual hosts
    UseCanonicalName Off

    # configures the footer on server-generated documents
    ServerSignature On


    # Optionally, include *.conf files from /etc/apache2/conf.d/
    #
    # For example, to allow execution of PHP scripts:
    #
    # Include /etc/apache2/conf.d/php5.conf
    #
    # or, to include all configuration snippets added by packages:
    Include /etc/apache2/conf.d/*.conf


    # ScriptAlias: This controls which directories contain server scripts.
    # ScriptAliases are essentially the same as Aliases, except that
    # documents in the realname directory are treated as applications and
    # run by the server when requested rather than as documents sent to the client.
    # The same rules about trailing "/" apply to ScriptAlias directives as to
    # Alias.
    #
    ScriptAlias /cgi-bin/ "/srv/www/vhosts/hostinger-print-sf/cgi-bin/"

    # "/srv/www/cgi-bin" should be changed to whatever your ScriptAliased
    # CGI directory exists, if you have one, and where ScriptAlias points to.
    #
    <Directory "/srv/www/vhosts/hostinger-print-sf/cgi-bin">
        AllowOverride None
        Options +ExecCGI -Includes
        <IfModule !mod_access_compat.c>
            Require all granted
        </IfModule>
        <IfModule mod_access_compat.c>
            Order allow,deny
            Allow from all
        </IfModule>
    </Directory>


    # UserDir: The name of the directory that is appended onto a user's home
    # directory if a ~user request is received.
    #
    # To disable it, simply remove userdir from the list of modules in APACHE_MODULES
    # in /etc/sysconfig/apache2.
    #
    <IfModule mod_userdir.c>
        # Note that the name of the user directory ("public_html") cannot simply be
        # changed here, since it is a compile time setting. The apache package
        # would have to be rebuilt. You could work around by deleting
        # /usr/sbin/suexec, but then all scripts from the directories would be
        # executed with the UID of the webserver.
        UserDir public_html
        # The actual configuration of the directory is in
        # /etc/apache2/mod_userdir.conf.
        Include /etc/apache2/mod_userdir.conf
        # You can, however, change the ~ if you find it awkward, by mapping e.g.
        # http://www.example.com/users/karl-heinz/ --> /home/karl-heinz/public_html/
        #AliasMatch ^/users/([a-zA-Z0-9-_.]*)/?(.*) /home/$1/public_html/$2
    </IfModule>


    #
    # This should be changed to whatever you set DocumentRoot to.
    #
    <Directory "/srv/www/vhosts/hostinger-print-sf/public">

        #
        # Possible values for the Options directive are "None", "All",
        # or any combination of:
        #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
        #
        # Note that "MultiViews" must be named *explicitly* --- "Options All"
        # doesn't give it to you.
        #
        # The Options directive is both complicated and important.  Please see
        # http://httpd.apache.org/docs/2.4/mod/core.html#options
        # for more information.
        #
        Options Indexes FollowSymLinks

        #
        # AllowOverride controls what directives may be placed in .htaccess files.
        # It can be "All", "None", or any combination of the keywords:
        #   Options FileInfo AuthConfig Limit
        #
        AllowOverride All

        #
        # Controls who can get stuff from this server.
        #
        <IfModule !mod_access_compat.c>
            Require all granted
        </IfModule>
        <IfModule mod_access_compat.c>
            Order allow,deny
            Allow from all
        </IfModule>

        FallbackResource /index.php
    </Directory>
    <Directory /srv/www/vhosts/hostinger-print-sf/public/bundles>
        FallbackResource disabled
    </Directory>
</VirtualHost>

```
