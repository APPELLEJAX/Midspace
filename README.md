# Midspace

A simple social network by midshipman, for midshipman.

# Using workspace directory

1. Make sure you have git installed

    > which git"

   if no response:

    > sudo apt-get git"

2. Add project folder to your filesystem

    > git clone https://github.com/APPELLEJAX/Midspace.git

    > cd Midspace

4. Now from inside the directory you can edit, update, and Collaborate

   view differences between your copy and master copy:

    > git status

   add your work to master copy:

    > git add *

    > git commit -m "<commit message goes here>"

    > git push

   update your directory with the work submitted by others:

    > git pull

# Organizations

app/              - All application files for our social network go here

app/views         - HTML and CSS files go here

app/controllers   - PHP scripts for generating pages go here.

app/helpers       - Javascript files go here.

app/resources     - Any included resources (pictures, icons, soundbytes) go
                    here. Include licensing information.

admin/            - Admin data for our social network goes here.

(ADMIN HIERARCHY COPIES APP)

db/               - Database-ish files go here (all our csv files)

docs/             - Collaborative documents (presentations, google docs) go here

lib/              - Any imported libraries (probably won't need any) go here.

# Meeting Logs
First group meeting: Nov 1
  Discussed team roles, general expectations for site, sketched up hopeful
  images. Planning to split into two teams in lab tomorrow. Jake and AJ will
  work on login page, and Jason and Charlene will work on navbar ssi.

Next group meeting: Friday 4 November after/for dinner to discuss first
milestone progress.

# COLOR SCHEME

.#660099 - lighter theme
.#440066 - darker theme

.#eeeeff - off-white
.#aaaacc - highlights
.#222222 - off-black (give matted feel)

# Highly recommend:

- Everyone work in atom text editor.
- Using the git terminal commands

# Tracking comments:

+ createuser.php
+ login.php
+ createpost.php
+ home.php

. profile.php //halfawy there. It's a bear.
              //should also add that ADD FRIEND   button...
              //and the post form...
              //profile is generally a bitch. I got it.

- search.php  //Add a little message if no one pops up.
              //Needs to be puclic... so we'll have to do some contingency work
- addfreind.php
- page.inc.php //easy gimme
- logout.php

# Work to be done.

1. The php commenting/refining above.
2. Commenting and refining the javascripts.
3. The css to make it all pretty.
4. Making a contact page.
5. FUCK FUCK SHIT FUCK we have to add these to how we do profiles and the
   sign up page:
     - full name.
     - USNA class year.
     - company number.
     - biography textarea.
     - (also kinda if they are admin or not)
  We'll deal with this when we get there... I'll deal with it when we get there.
6. List memebers page. (Just a link to a search with "" as the regex.)
7. Profile Update page... balls.
8. Admin area with
    - Manage Users (i.e. delete users.)
    - Statistics page (number of members, number of status updtes, %moods)
9. More pretty-ness with css at this point.
10. Make a file to store each user's posts. (Won't actually do anything with it
    but it's a requirement.)
11. The project report. 
