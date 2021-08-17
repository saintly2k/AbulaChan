<h2 id="">Table of Contents</h2>
- <a href="#Important Announcement">Important Announcement</a> <br>
- <a href="#title">Introduction</a> <br>
- <a href="#features">Features</a> <br>
- Installation <br>
- - <a href="#For the first time">For the first time</a> <br>
- - <a href="#new-boards">Adding new Boards</a> <br>
- - <a href="#customizing">Customizing Boards</a> <br>
- - <a href="#News?">News?</a>
- - <a href="#">Upgrading from older Versions</a>
- <a href="#">To-do/Contribution

# Important Announcement
I'm searching for someone to help me at this project making something like a theme selector or so, also I want to make it that you can upload the images instead of just linking to them, if anyone could help me with that, I would be very grateful! But nothing more at the moment...

# AbulaBoard
Your daily Textboard/Imageboard. Written in PHP and HTML and it can be used without Database (it's flatfile)! Actually, it's a continued version of the old Bazuchan.

# Features
- A decent Imageboard/Textboard
- Some cool preset Banners
- Theme support!
- A not working reset.php
- A life demo: http://chan.abulafia.space
- For the exact code shown here: http://chan.abulafia.space/GITHUB
- idk what more?

# Installation

## For the first time
1. Download the stuff & unzip it.
2. Setup `config.php` in the main directory, you need to change these: `$mypagetitle`, `$subtitle`, `$antispam_word` and `$mysecretword` (and that for all `config.php` files you got, also in sub-folders).
3. Images (`$enable_guest_images`) are set to true by default, you can disable them by setting it to `false`
4. (Optional) If you have images enabled, you can change the size of them by changing the `$guest_image_size` to something else. (MAKE SURE YOU ALWAYS GIVE THE SIZE IN PIXEL, OR ELSE IT WON'T WORK!)
5. Edit files in the `/stuff/` directory: `header.php` and `index_header.php`
6. `header.php`: Link there to all your existing boards in `$pageheader`
7. `index_header.php`: For `$index_header` copy the stuff from `header.php` there and fix the links, for `$index_boards` you can do it how you like (still you should link to them)
9. MAKE SURE YOU HAVE CHMOD 777 ON THE FOLDER!
10. Setup boards (explanation below)

## Adding Boards
1. Copy the files out of the `template` directory into the folder(e.g: /a/ for anime).
2. Edit `index.php` and `config.php` to your likings (as mentioned above).
3. Edit `header.php` in the folder above and add a links to it.
4. Link the board in the `/stuff/header.php` file
5. Done kekw

## Customizing Boards
1. Find the `config.php` file in your directory
2. Find the `$theme`
3. Edit the current theme to whatever theme is in the `/themes/` folder
4. ur done

## News?
1. Yes, find the `/news/` directory
2. Edit `config.php` to your likings
3. Add news in `news.php`
4. They will show up there but also show up on the home-page, awesome, init?

## Upgrading from older Versions
1. Delete those files: `index.php`, `config.php` and `gb-exec.php`
2. DON'T DELETE THE `gbcontentfile.php`, THIS IS WHERE YOUR POSTS ARE STORED!
3. Upload the new files (make sure you don't replace `gbcontentfile.php` in any way

# To-Do / Contribution
- [x] Get the `reset.php` somewhat working... NOT! YOU CAN DO THAT MANUALLY BY DELETING `gbcontentfile.php`! I'm too lazy...
- [ ] Make image resize better??? Maybe...
- [x] Make smth like "Change Theme" in config.php and styles.css, ya know?
- [ ] Improve Theme-changer, add new themes & Community support (Docs?)
- [ ] Send help

xd pls halp me making this board better if you can, make a pull request xdddd
