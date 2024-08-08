# Free-Write
A Reader-Focused Social Storytelling Platform

`admin` password: root

Color Palette:
black: 001000
brown: 845E52
creamish: f7c5b0
pink: f5bcb9
grey: f2e1d9

M - Data related logic, select-insert-update-delete, talk to controller
V - UI, talk to controler, html-css-js, 
C - receive input FROM view, process request (get-post-put-delete), gets Data FROM model, pass data TO view


User -> URL -----> router ------> controller <=======> model <=====> DB
                                       |
                                       V
                                      view

> No matter what we are browsing, we should only be able to access 1 page
> robots.txt: tells the search engine what to index and what not to index (here we are telling do not index ajax and admin related pages)

> if the php file does not contain any html element, then do not add the closing php tag "?>"

> the video explains using CORE folder, but in here its "includes"
> autoload.php is the init.php
> why Controller in as php files for classes is that there might be functions that are used by every contoller so we can put them in a single file and include it in every controller

> have a controller for each page/view
> have a model for each table in the database in models folder; 
        we can reuse the common functions in the includes/Model.php