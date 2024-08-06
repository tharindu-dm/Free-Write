# Free-Write
A Reader-Focused Social Storytelling Platform

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
