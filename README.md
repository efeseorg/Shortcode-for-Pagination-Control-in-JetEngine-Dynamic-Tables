# Shortcode for Pagination Control in JetEngine Dynamic Tables

This WordPress shortcode allows you to add a user interface for controlling the pagination of rows in a dynamic table generated with JetEngine. Users will be able to select how many rows to display per page and navigate through the table's pages.

## What this Shortcode Does

The `[filas_por_pagina]` shortcode inserts an interactive control on your page consisting of:

* **A dropdown menu:** Allows users to choose the number of rows to display per page (options: 10, 20, 50, 100).
* **Pagination links:** Dynamically generated to navigate between the different pages of the table.

## Components

### PHP Function

The PHP function executed when using the shortcode generates the HTML structure for the rows-per-page selection control and adds the necessary JavaScript and CSS for its functionality.

### HTML

The generated HTML includes a `<select>` element with the ID `rows-per-page` within a container with the ID `control-de-filas`. This selector provides the options for the user to choose the number of rows per page.

### JavaScript

The JavaScript script, using jQuery, implements the pagination logic:

* **`initializePagination()`:**
    * Responsible for getting all the rows of the dynamic table on the page.
    * Calculates how many pages are needed based on the total number of rows and the selected number of rows per page.
    * Generates the pagination links and adds them to a container with the ID `pagination-container`.
    * Assigns the functionality to display the corresponding page when a pagination link is clicked.
* **`paginate(rows, rowsPerPage)`:**
    * This function takes the table row collection and the number of rows per page as input.
    * Returns the total number of pages required to display all rows.
* **`showPage(page)`:**
    * Receives the page number as an argument.
    * Displays only the table rows corresponding to the specified page, hiding the others.
* **Events:**
    * **`change` on the rows-per-page selector (`#rows-per-page`):** When the user changes the number of rows per page in the dropdown menu, the table's pagination is recalculated and updated.
    * **`jet-filter-content-rendered`:** This event (specific to JetEngine) is listened for to reinitialize the pagination whenever the table content is updated or filtered using JetEngine's features. This ensures pagination works correctly even after applying filters.

### CSS

The CSS styles provide the visual appearance of the selection control and pagination links:

* **`#control-de-filas`:** Styles for the container of the rows-per-page dropdown.
* **`#control-de-filas select`:** Specific styles for the `<select>` element.
* **`#pagination-container`:** Styles for the container that will hold the pagination links. **It is crucial that a `div` with this ID exists on your page for the pagination links to display correctly.**
* **`.page-link`:** Styles for each individual pagination link.
* **`.page-link.active`:** Styles for the pagination link representing the currently visible page.

## Usage

To integrate this pagination control into your JetEngine dynamic tables:

1.  **Ensure that the PHP function for the shortcode is added to your child theme's `functions.php` file (or via a code snippets plugin).**
2.  **On the page or post where your JetEngine dynamic table is displayed, insert the shortcode `[filas_por_pagina]` in the location where you want the pagination control to appear (e.g., above or below the table).**
3.  **It is essential that on the same page where you insert the shortcode, a `<div>` element with the ID `pagination-container` exists.** The JavaScript script will use this `div` to display the pagination links. Make sure to add something like `<div id="pagination-container"></div>` in your page structure.

By following these steps, users will be able to control how many rows of your JetEngine dynamic table are displayed per page and easily navigate through the results.
