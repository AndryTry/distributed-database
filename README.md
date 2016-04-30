# Distributed Databases

This is the final project of the distributed database course in my collage.

The main idea is using multiple database server, distributed over network and process distribute data managed by 
application. In this program data distribute by identify `id` of the data, example if `id` data start with `1` it 
will be save in server 1, data start with `2` will be save in server 2 and so on.

## Network Topology

Sample network topology

![network-topology]()

## Design Database Scheme
 
This is sample design database scheme of the program. both database using same scheme.

![relational-database]()

## Distribute model

This program will identify first number of id, and then connect to the proper database server, example:

```python
nim = '15122043'
connect = connection(nim[0])
```

## Installation

