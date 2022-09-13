# Task management

####Create a very simple Laravel web application for task management:

- Create task (info to save: task name, priority, timestamps)
- Edit task
- Delete task
- Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
- Tasks should be saved to a mysql table.
#####BONUS POINT: 
- add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

You will be graded on how well-written & readable your code is, if it works, and if you did it the Laravel way.

Include any instructions on how to set up & deploy the web application in your Readme.md file in the project directory (delete the default readme).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## How to setup & deploy

Download the project & run

    `composer install`

    `copy .env.example .env`

Create Database & Set config file(.env)

    `php artisan migrate`

    'npm install'
    'php artisan serve'


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
