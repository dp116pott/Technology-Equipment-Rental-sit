# Technology-Equipment-Rental-sit
Web application source files of program developed for equipment rental company
Brief Description of Architecture: Uses Mysql for database
This project can be split into 2 main core operations:
1) The information desk, this contains all the relevant know how for the company, i.e. its products its model and
   who they are.
2) The Rental service itself, this entails the dynamic rental software design which allows users to select tools from
   the stock of currently available products and receive an immediate quote and booking. This service does not incorporate
   online payment methods as the client chose to maintain their face to face contact payment method. The biggest hurdle
   with this project was managing the changing needs of the client throughout the process.
   The most impactful edge case was the catch where if a product is out of stock and a customer chooses to rent it from
    when it is in stock and then chooses an end date from when none are currently available
   this would create a direct clash. This forced me to curate the program to keep track of each individual item's availability
   to better edit the system block on date selection for when no items are available.

Finally, this project is publicly viewable and was implemented at: https://www.technologyequipmentrental.com/
Though the front end contains changes to the UI as I was informed by the client would occur, the core 
functionality remains the same and the underlying backend is fixed.
