# UQ Cycle Club Shop

This is an *extremely* lo-fi store to make it easier for UQCC members to order kit and easier for administrator's to place those orders. 
It's basically only functions as an email creator, payment is still processed via bank transfer and the website is updated manually.

Orders are stored as JSON in one very simple DB table. This is somewhat flimsy and obviously not relational or scaleable.

## The Plan

Is to switch to Sinatra and put all the products into a DB table.

## New Features

* Have a list of all orders linking through to their receipt pages.
* Add extra info to the receipt pages: name, email
* Allow admin to manually mark an order as paid