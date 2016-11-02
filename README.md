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

app/viess         - HTML and CSS files go here

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
