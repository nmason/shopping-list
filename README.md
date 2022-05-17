# Shopping List Assessment Project

This assignment is designed to assess the following:

- You will show how to create a new laravel application, with starter kit jetstream.
- You will demonstrate how to create a basic route, controller and model.
- You will demonstrate how to create a vue.js application coupled with inertia.js
- You will demonstrate how to create a unit and feature test using php unit or pest
- Demonstrate your understanding of a question, and interpretation of a question.
- Demonstrate your attention to detail
- Demonstrate your ability to know what is required even with a brief description.
- Demonstrate your efficiency, code readability and coding style.
- Demonstrate use of Git and GitHub.




### This assessment is expected take approximately 5-10 hours to complete.

## Example:

Please see [https://assessmentproject.urbanlightbulb.com/](http://assessmentproject.urbanlightbulb.com/) for example. You can register a new user account to obtain a test login ( https://assessmentproject.urbanlightbulb.com/register ).

### Notes & Tips

> **Note Regarding Inertia (If you have not use Inertia before):** [Inertia](https://inertiajs.com/) is a rendering/view framework that provides both server side laravel and client libraries enabling a single page application built with vue.js using traditional laravel application routes. The requirements for this assessment are very basic, and you should be able to pick it up very quickly by looking at the existing examples and from the inertia website documentation ([Rendering Inertia Views](https://inertiajs.com/routing) and [Partial Reloads](https://inertiajs.com/partial-reloads)).

>  **Important**: You must branch each task as described and only commit to that branch - this will help us understand what you have changed at each section.

### CSS Styling

This assessment does not assess your css / tailwind abilities. Tailwind is a utility-first css framework allowing you to style entirely with html classes. It is acceptable to use the browser web inspector on the sample example to find classes to style your assessment project.




### Prerequisites:

-  You will require your choice of GitHub, GitLab or a BitBucket account
- You will need your own php development environment with mySql or Postgres as well as NodeJs for compiling assets using laravel mix.
- Your dev environment must be ready for active laravel development and Vue.js development.


# Steps / Instructions

Updated: **Start at Step 3**
>  Start at step 3 - Checkout branch '2-departments' and run the following commands

##### Getting started guide ( For Starting at step 3, branch '2-departments' )
add a .env file (or rename .env.example adding in your database properties


    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=shopping_list
    DB_USERNAME=
    DB_PASSWORD=

Run the following commands in terminal


    $ composer install
    $ npm install
    $ php artisan migrate
    $ php artisan key:generate
    
    $ npm run watch
**Note:** Start serving from your preferred web server.   

>  It's recommended you still read through step 1 & 2 so you understand what steps have been taken.

  

## Step 1



1.  Initiate a new Laravel 9 project,
2.  Initialize using laravel and install jetstream using inertia.js option. (This will create user and auth scaffolding with associated models as our starting point)
3.  Setup your .env configuration.
4.  Migrate your database.
5.  Ensure all your tests are passing before commiting
6.  Initialize your Git Repository and commit, publish to master / push to GitHub with the commit message “1. Initialized shopping list example project’

## Step 2

1.  Create a new Department Model
2.  Create a new git branch ‘2-departments’ and checkout branch
3.  Add Model, Migration and Resource Controller with Route.
4.  Create a route resource with /departments path
5.  Add the following attributes that need to be stored in addition to the id, and timestamps:
6.  ‘name’, should be no longer than 64 characters and is required.
7.  ‘slug’, should be no longer than 64 characters and is required.
8.  Has a user one-to-one relationship
9.  Create a index view listing each departments, sort by name in ascending order
10.  Ensure departments are scoped to only show departments for that user
11.  Create a new & edit view with associated save / update controller logic
12.  The department is assigned to the user that is logged in.
13.  Create a validation rule that requires the department that has a minimum of 5 characters and no more than 64 characters.
14.  Allow user to only click save when the form is dirty.
15.  Use tailwind css to apply some basic styling to the forms.
16.  Create a url slug from the department name, this should be URL friendly and contain only alphabetic or numeric characters are used - replacing whitespace for a single hyphen (-) ie. ‘wine-and-beer’.
17.  Ensure the department is unique against the user.
18.  Create appropriate navigation links. Ie. ‘Departments’, ‘Save’, ‘Cancel’ etc.
19.  Ability to delete a department using a soft delete.
20.  Include feature/unit test for:
21.  Creating a department
22.  Editing a department
23.  Listing departments for only the logged in user
24.  Ensure all tests pass, add any logic required to make test pass with desired outcome.
25.  Your tests should include testing specifically that a user_id has been assigned and that a slug is generated.
26.  Including that a slug is created
27.  The route path should utilise the slug where
28.  Commit and publish branch to GitHub with commit message ‘2. added departments’
**![](https://lh3.googleusercontent.com/E2L_GtPe7_Z--w9MGqr2-YgYGlvNaXmiLMictYu6ApB-48OS5aeVxP4G-M_Y6QxERJX0HDsU4zk9cuKJSmlXR4ZwesYsl9uT3-kgDIgKGzPdMiUN7k12W9lCk7rgBDmScqUMIC9buBk1nQJ3Fw)**

## Step 3
1.  Create a new ‘Item’ Model
2.  Create a new git branch ‘3-items’ and checkout branch
3.  Add Model, Migration and Resource Controller
4.  Create a route resource with /items path
5.  Add the following attributes that need to be stored in addition to the id, and timestamps:
6. ‘name’, should be no longer than 128 characters and is required.
7.  Has a department one-to-one relationship
8.  Create a index view listing each item, sort and group by department in ascending order
9.  Each department should have a subheading, followed by a list of items that is within that department.
10.  Ensure items are scoped to only show departments & items for the currently logged in user
11.  Create a new & Edit view with associated controller save / update logic
12.  Name is required with client and server validation.
13.  Client validation should make input box background red
14.  Has ability to select from available user departments
15.  Ability to delete an item
16.  Create a department show page that includes a list of items that relate to that department.
17.  Include feature/unit test for:
18.  Creating a item
19.  Listing items for only the logged in user
20.  Items are grouped by associated department
21.  Department show page contains associated items
22.  Ensure all tests pass, add any logic required to make test pass with desired outcome.
23.  Commit and publish branch to GitHub with commit message ‘3. added items’
![](https://lh5.googleusercontent.com/meA4Oxr4Em-No7KvbUP1MsOt191GpKjo19ZrHnvi_E0UVrEoFlUttYyahEnT3d3SGThBma-q37-E7UT8v7IUVe_t-ePXOdx68vGMidEED4JGw9cZMorabBhH5vhYseCeU9GUxtrqxfvhT6dPFw)
24.  Create a new ‘ItemList’
25.  Create a new git branch ‘4-item-list’ and checkout branch
26.  Add Model, Migration and Resource Controller
27.  Create a route resource with /list path
28.  Add the following attributes that need to be stored in addition to the id, and timestamps:
29.  ‘Quantity’
30.  ‘Purchased’ (a boolean attribute)
31.  Belongs to items
32.  Create a index view listing each line item, sort and group by department in ascending order
33.  Each department should have a subheading, followed by a list of line items that is within that department.
34.  Line items display with the item name as the title, and display the quantity
35.  Ensure items are scoped to only show line items for that user
36.  The index page contains a input box displaying the quantity - this updates the quantity in real-time when the user leaves the input box only when the value is changed
37.  The index page contains a add new box, which contains a select box with all the items sorted by department, it also contains a quantity box defaulting to 1. The form saves from the index and refreshes the page via javascript (does not refresh the browser page)
38.  The quantity cannot go below 0 - include a vue computed method evaluates if a the quantity is below 0 with attached class and tailwind style.
39.  Line items can be deleted.
40.  Include the Feature / Unit tests you think are required
41.  Commit and publish branch to GitHub with commit message ‘4. added item list’

## Step 4
1.  Create a new ‘ItemList’
2.  Create a new git branch ‘4-item-list’ and checkout branch
3.  Add Model, Migration and Resource Controller
4.  Create a route resource with /list path
5.  Add the following attributes that need to be stored in addition to the id, and timestamps:
6.  ‘Quantity’
7.  ‘Purchased’ (a boolean attribute)
8.  Belongs to items
9.  Create a index view listing each line item, sort and group by department in ascending order
10.  Each department should have a subheading, followed by a list of line items that is within that department.
11.  Line items display with the item name as the title, and display the quantity
12.  Ensure items are scoped to only show line items for that user
13.  The index page contains a input box displaying the quantity - this updates the quantity in real-time when the user leaves the input box only when the value is changed
14.  The index page contains a add new box, which contains a select box with all the items sorted by department, it also contains a quantity box defaulting to 1. The form saves from the index and refreshes the page via javascript (does not refresh the browser page)
15.  The quantity cannot go below 0 - include a vue computed method evaluates if a the quantity is below 0 with attached class and tailwind style.
16.  Line items can be deleted.
17.  Include the Feature / Unit tests you think are required
18.  Commit and publish branch to GitHub with commit message ‘4. added item list’


![](https://lh4.googleusercontent.com/WLKkOC1mi617P98RtsR-N3CvUFSsIRmdQSy3R1WIrJnU9y9Rh-2BfXJAWXyvBx38fikof8mEqju-IiFPDPrhK5tiGkN8n2J4ulAUfQQ4LpoX2Q6x2APPYsqQm60MlBQzsEpegEfEvgFChFDy5w)

## Step 5
1.  Create a new git branch ‘5-refactor and checkout branch
2.  Refactor the above code for better efficiency and maximum readability
1.  Include PHP Code Docs where needed
2.  Ensure anything needed testing has an associated test
3.  Refactor your code for optimum readability and DRY code
4.  Add any enhancements or changes you would make instead of the described actions above.
5.  Commit and publish branch to GitHub with commit message ‘5. Refactor’



## Submit your Git repository & Remote Developer Application:

Complete the following form to submit your assessment:
[https://docs.google.com/forms/d/e/1FAIpQLSeg4Hae8GHDeCQXu6brgGNXi7nC2QtoeZ9dWgwSFegXTi5Q0w/viewform?usp=sf_link](https://docs.google.com/forms/d/e/1FAIpQLSeg4Hae8GHDeCQXu6brgGNXi7nC2QtoeZ9dWgwSFegXTi5Q0w/viewform?usp=sf_link)