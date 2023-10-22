## Getting started

1. **composer install** to install the project's PHP dependencies specified in the `composer.json` file.
2. **npm install** to install the project's JavaScript dependencies defined in the `package.json` file.
3. Duplicate the `.env.example` file located in the project's root directory and rename it to `.env`.
4. Modify the `.env` file and set the necessary configuration options such as database connection details.
5. php artisan key:generate to generate a unique application key for your Laravel project.
6. php artisan migrate
7. npm run dev
8. php artisan serve to launch a development server, and you can access your application by visiting `http://localhost:8000` in your web browser.

## The problem to be solved in your own words

The problem to be solved is to create a back-end admin page where the admin can log in and manually trigger a crawl of a website. The crawl should extract all internal hyperlinks from the website, store the results temporarily in the database, and display them on the admin page. Additionally, the crawl should be scheduled to run automatically every hour.

## **Technically how I solved it, why and how it works**

To solve this problem, I would propose the following technical solution:

1. Create an admin login system using a suitable authentication mechanism in the chosen web framework (e.g., Laravel). This will allow the admin to securely access the admin page.
2. Develop a dashboard in the admin panel where the admin can trigger the crawl manually. This can be implemented as a form submission or a button click that initiates the crawl process.
3. Implement a scheduled task using a task scheduler (e.g., Laravel's built-in task scheduler or a cron job) to run the crawl automatically every hour. This can be achieved by scheduling a command to execute at the desired intervals.
4. Create a command (e.g., `crawl:website`) that will handle the crawl process. This command will perform the following tasks:
   * Delete the results from the previous crawl from the temporary storage in the database.
   * Start at the website's root URL (home page) and crawl all internal pages.
   * Extract all internal hyperlinks from each page.
   * Store the results temporarily in the database, associating them with the crawl session.
   * Update the admin page to display the results of the latest crawl.
5. Use appropriate libraries or built-in functions to parse the HTML and extract the hyperlinks. For example, you can use DOM manipulation libraries like PHP's DOMDocument and DOMXPath to traverse the HTML structure and extract the `<a>` tags.
6. Ensure error handling and exception handling throughout the code to handle scenarios such as invalid URLs, connection issues, or parsing errors.
7. Implement proper logging mechanisms to capture any errors or exceptions that may occur during the crawl process. This will help in troubleshooting and debugging if any issues arise.

## How your solution achieves the admin’s desired outcome per the user story

By implementing this solution, the admin will have a secure login system to access the admin panel. They can manually trigger the crawl and view the results on the admin page. The crawl will run automatically every hour, providing updated results on a regular basis. The crawl process will delete previous results, crawl home page, store the hyperlinks in the database, and display them to the admin, achieving the desired outcome as per the user story.

## How you approach a problem

While moving toward an issue, I commonly follow a methodical methodology that includes grasping the prerequisites, examining the requirements and conditions, separating the issue into more modest parts, and planning an answer that tends to the particular necessities.

## How you think about it

I think about the problem by considering the desired outcome, the stakeholders involved, and the resources available. I also consider the scalability, maintainability, and extensibility of the solution to ensure it can adapt to future changes or requirements.

## Why you chose this direction

I chose the direction mentioned above for solving the problem because it aligns with the requirements specified. It provides a secure admin login system, allows manual triggering of the crawl, and implements an automated crawl process using a scheduled task. Storing the results temporarily in the database ensures data persistence and retrieval for display on the admin page. By using web framework features such as authentication mechanisms, task schedulers, and database integration, we leverage existing tools and functionality, reducing development time and effort.

## Why this direction is a better solution

This direction is a better solution because it provides a comprehensive and efficient approach to address the problem. The admin page with login functionality ensures secure access and proper authentication. The manual trigger allows the admin to initiate the crawl as needed, giving them control over the process. The scheduled task ensures regular and automatic execution of the crawl, reducing manual intervention. Storing the results in a database allows for easy retrieval and display on the admin page. Overall, this direction provides a well-rounded solution that meets the requirements and offers scalability and maintainability for future enhancements.
