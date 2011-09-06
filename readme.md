# UQ Cycle Club Shop

This is an *extremely* lo-fi store to make it easier for UQCC members to order kit and easier for administrator's to place those orders. 
It's basically only functions as an email creator, payment is still processed via bank transfer and the website is updated manually.

Orders are stored as JSON in one very simple DB table. This is somewhat flimsy and obviously not relational or scaleable.

I started this a while ago and that's why it's PHP. If I started over again today it'd be in Ruby/Sinatra.