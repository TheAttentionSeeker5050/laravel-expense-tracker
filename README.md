# Laravel Budget Tracker

This is a project for a Budget Tracker using Laravel pages. 



## Project Requirements:

A page for managing Budget Categories, and one for Expenses


**Budget Categories:**
Index view displays a list of all budgets with Title and amount displayed.
Ability to add and edit budget categories.
Create and edit pages include link to view budget category index.
Budget categories will include title, and budget field. Both fields are required. Title will be limited to 255 characters. Budget will only allow whole numbers e.g 200.
Add and Edit pages must contain a link to get to the categories index view.
Server-side validation required. Appropriate validation messages should be displayed.


**Expenses:**
index view displays list of budget categories with Title and budget amount displayed. Under each budget will be a list of the current month’s expenses.
Ability to add, edit and delete expenses.
Each budget category will also display a progress bar indicating the percentage of the total budget spent that month. If 50% of the budget has been spent, then the bar should span 50% of the total width.
Depending on the total percentage spent, the bar will be a different color.


* Green: <100% of budget spent
* Yellow: 100% of budget spent
* Red: >100% of budget spent


Index page includes the ability to view other months budget/expenses using previous/next month buttons.

Ability to add a new expense with description, amount, and category field. Category field is a `<select>` with options filled in from the database. All fields are required.
Description will have character limit of 255.
Amount will allow floats with 2 decimal places. For example, 20 and 20.22 would both be valid values.

When adding an expense, the date for the expense will be set based on the month/year the user was viewing on the index page.
Add, Edit and Delete pages must include a “back” link to the index view with the appropriate monthly budgets displayed. i.e if the user is viewing expenses for January 2023, clicks the “add expense” button, and then clicks the “back” button they would still be viewing the January 2023 expenses.
After an expense is deleted, the user should be redirected to the expense index page in the current month/year they came from. (just like in the previous bullet point)
Server-side validation on all forms.


**Other considerations:**

All URLs and redirects should be generated using named routes.
All pages should be user friendly and responsive.
Git should be used throughout development of your project. Remember to commit often and to include message that describe what the commit contains.
App should not crash if no expenses or budget categories are in the database.
The database tables must be created using migrations, not a .sql file.
To aid in testing, submit your project with no budget category or expenses in the database.
You can use Seeders to generate test data but it is not a requirement.
There should be a navigation menu to move between /budgets and /expenses pages


## Design Charter




### The Data Models



### Routes and Controllers



### Validation, Authorization and Helper Functions



### View and Data Presentation
