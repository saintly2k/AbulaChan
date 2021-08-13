# Important Announcement
I'm searching for someone to help me at this project making something like a theme selector or so, also I want to make it that you can upload the images instead of just linking to them, if anyone could help me with that, I would be very grateful! But nothing more at the moment...

# AbulaBoard
Your daily Textboard/Imageboard. Written in PHP and HTML and it can be used without Database (it's flatfile)! Actually, it's a continued version of the old Bazuchan.

# Features
- A decent Imageboard/Textboard
- Some cool preset Banners
- A not working reset.php
- A life demo @ http://chan.abulafia.space
- For the exact code shown here @ http://chan.abulafia.space/GITHUB
- idk what more?

# Installation
1. Download the stuff & unzip it.
2. Setup `config.php` in the main directory, you need to change these: `$mypagetitle`, `$subtitle`, `$antispam_word` and `$mysecretword`.
3. For images you need to set `$enable_guest_images` to true (false is default and recomendet since it doesn't work properly)
4. Setup `index.php` in the main directory, you need to change these: at the top in the `<center>` tags your boards, in the `<fielsdset>` tag your boards and your news (currently in work).
5. Setup `header.php`, you need to change these: add your boards in there with HTML markup, example is already written there.
6. MAKE SURE YOU HAVE CHMOD 777 ON THE FOLDER!
7. Setup boards (explanation below)

# Adding Boards
1. Copy the files out of the `template` directory into the folder(e.g: /a/ for anime).
2. Edit `index.php` and `config.php` to your likings.
3. Edit `header.php` in the folder above and add a link to it.
4. Edit the `index.php` in the same directory as `header.php` and link the board there.
5. Done kekw

# To-Do / Contribution
- []  Get the `reset.php` somewhat working... NOT! YOU CAN DO THAT MANUALLY BY DELETING `gbcontentfile.php`! I'm too lazy...
- []  Make image resize better??? Maybe...
- []  Make smth like "Change Theme" in config.php and styles.css, ya know?
- []  Send help

xd pls halp me making this board better if you can, make a pull request xdddd
