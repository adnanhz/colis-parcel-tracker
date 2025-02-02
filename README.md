# Colis Parcel Tracker

A mini web platform for order tracking management.  

## Draft

### Preliminary Data
- Products, which they enter once or occasionally via the products interface 
- Employees (all users are admin), which I will add directly from the database

### Daily Data
- A new order is manually entered by an employee. The order includes the client name, address, the product, etc. Each order has a state. States are "new", "dispatched", "canceled" or other.

### Key Points
1. Multiple search and filtering options
1. Order states are the top-most level of the interface. Which means you navigate to Home>New, Home>Dispatched, etc and see respective orders. There can also be a Home>All for all states together.
1. Parcel state change is logged. It must be known which employee changed the state of the parcel and when.  
1. When a parcel is moved from new to dispatched, it's not immediately removed from "new", but is marked as dispatched in new for a limited period of time (how long?) to allow the user to understand that it has been moved, not disappeared or deleted.
1. Refreshing of order states and retrieval of new orders is done with the push of a button (not realtime!).
1. All orders must be exportable to Excel.  
1. Interface must be in Arabic language


### No-Goes
Implementing the following features requires additional effort and could be implemented at later stages based on business agreements.
1. Realtime interface updates (using Websockets)
1. Bulk add/delete/edit orders
1. Notifications when an order state changes
1. Any financial analytics
1. Graphs, charts displaying monthly growth for example  
1. Client accounts where you can add clients and see orders of a specific client (outside of the regular filter)
1. User management (includes resetting passwords, adding new users, etc.)
1. Any email integration
1. Mobile integration