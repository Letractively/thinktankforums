<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>The Think Tank Forums Project: Web forum software for the data obsessed</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="icon" type="image/png" href="/images/icon.png" />
    </head>
    <body>
        <div id="header">
            <img src="images/header_logo.gif"
                 alt="the think tank forums project"
                 width="620" height="100" />
        </div>
        <div id="content">
            <h1>Welcome to the Think Tank Forums Project</h1>
            <p>This is the official website for the Think Tank Forums (TTF) 
            Project, <strong>BSD licensed</strong> web forum software that 
            uses <a href="http://www.php.net/">PHP</a> and 
            <a href="http://www.mysql.com/">MySQL</a>. To see our software in 
            action, check out 
            <a href="http://www.thinktankforums.com/">Think Tank Forums</a>, 
            our sister site. On this page, you'll find our project goals, 
            milestones, source code, and further development information.</p>
            <h2>Project goals</h2>
            <p>The TTF Project aims to produce extremely <strong>fast</strong> 
            and <strong>clean</strong> web forum software. The forum lacks 
            most features offered by other software&mdash;a fact of which we 
            are extremely proud.</p>
            <p>Our primary aims include:</p>
            <ul>
                <li>Fast: use optimized MySQL queries and proper PHP.</li>
                <li>Clean: keep the feature set and the source unbloated.</li>
                <li>Data obsessive: maximize information retention.</li>
            </ul>
            <p>Of course, we also care about security and an intuitive layout. 
            Security is easy because best practices are easy to implement and 
            track with clean source. An intuitive layout can flourish when 
            unnecessary features are avoided and XHTML is valid.</p>
            <h2>The data obsession</h2>
            <p>To prevent losses of information, TTF software does not offer 
            traditional edit and delete features. Instead, TTF offers a 
            <strong>versioning system</strong> that allows content to be 
            revised or archived, both with full content retrieval.</p>
            <p>We realize that many users appreciate the option of permanently 
            removing their contributions, and that people will be less willing 
            to post without such options. However, the project holds that 
            all information is valuable, and the costs of storage are minimal. 
            Furthermore, user deletion of threads removes others' content 
            without their permission, and user deletion of posts can make 
            the resultant exchanges appear incoherent.</p>
            <h2>Milestones</h2>
            <p>The project is still approaching an official stable release.</p>
            <h2>Source code</h2>
            <p>Source is only available via Subversion, because the project
            hasn't yet made an official release. You may access our repository
            <a href="http://code.google.com/p/thinktankforums/source/checkout">here</a>.</p>
            <h2>More information</h2>
            <p>You may learn more by visiting <a href="http://code.google.com/p/thinktankforums">our Google Code project page</a>.</p>
        </div>
        <div id="footer">
            Copyright &copy; 2007-2008 The Think Tank Forums Project.
            Last updated on 2008-11-03.
            This page is <a href="http://validator.w3.org/check?uri=referer">valid XHTML 1.1</a>.
        </div>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
            var pageTracker = _gat._getTracker("UA-2195624-1");
            pageTracker._trackPageview();
            } catch(err) {}
        </script>
    </body>
</html>