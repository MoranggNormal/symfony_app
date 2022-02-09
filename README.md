# Back-end using Symfony

This is a backend project, i'm doing this for Auryn's test.

### These are some things i did:

- Create a MySQL (or MariaDB) database;
- Create a controller:

> Filtering all the users without returning their password;

> Filter by email, to prevent account with same email;

> Post to create a new user account;

- Create a repository with two handmade functions (findAllUsers and filterEmail)
- Create an entity named User;

#### How can i use this?

Sure, i do not know, i'm completely new on these backend things.

Maybe you can go to <a href="https://github.com/paulopmt1/docker-symfony-environment"> Paulo's docker-symfony-environment</a> and follow the steps, and then move only my <code>src</code> and <code>migrations</code> folder to your own environment and use it with my <a href="https://github.com/MoranggNormal/vue-form-handler">Front-end form handler project</a> designed to work with this one.
