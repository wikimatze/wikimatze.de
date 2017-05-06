---
title: Playing around with MongoDB
description: Playing around with MongoDB
categories:
---

## Introduction

It's an Open-source NoSQL database. NoSQL means that those databases have no relations and do not have a query
language. It's document oriented and suitable for unstructured data, especially if you have many of it.


## Terms
Tables from SQL are named as collections and rows are named as documents.


Collections are group of documents. Since documents exist independently, they can have different fields. So column
names and value can differ from document to document in one collection. This behavior is called *dynamic schema*.


## Installation

```sh
$ sudo apt-get install mongodb
```


and starting it:


```sh

wm@wm » mongo
MongoDB shell version: 2.4.9
connecting to: test
Welcome to the MongoDB shell.
For interactive help, type "help".
For more comprehensive documentation, see
        http://docs.mongodb.org/
Questions? Try the support group
        http://groups.google.com/group/mongodb-user
Server has startup warnings:
Sat Jul  2 08:59:27.573 [initandlisten]
Sat Jul  2 08:59:27.573 [initandlisten] ** NOTE: This is a 32 bit MongoDB binary.
Sat Jul  2 08:59:27.573 [initandlisten] **       32 bit builds are limited to less than 2GB of data (or less with --journal).
Sat Jul  2 08:59:27.573 [initandlisten] **       See http://dochub.mongodb.org/core/32bit
Sat Jul  2 08:59:27.573 [initandlisten]
>
```


## Interactions with the SHELL

In the command line you can interact with the database using JavaScript:

```sh
> var padrino = {
... "name": 'Matthias',
... "vendor": 'Padrino'}
> padrino
{ "name" : "Matthias", "vendor" : "Padrino" }
>
```


Documents are like JSON-like objects


switch to a databses:


```sh
> use ruby;
switched to db ruby
```


If database doesn't exists, it will be created automatically. `db` prints the current database. `help` will print
the help menu. `show dbs` show list of databases, there names as well as there sizes.


Saving documents:

```sh
> db.frameworks.insert(
... {
... "name": "Padrino"}
... )
```


You get a WriteResult back. Use `find()` will return all documents in a collection:


```sh

> use locale
switched to db locale
> db.frameworks.find()
{ "_id" : ObjectId("57776aa0252019f07ff9f156"), "name" : "Padrino" }
```


## Queries, Data Types, Validations
The `_id` field is for the unique ids, which is automatically generated. `find()` can also take arguments to search
for a specific document:


```sh
> db.frameworks.find({ 'name': 'Padrino'})
{ "_id" : ObjectId("57776aa4252019f07ff9f157"), "name" : "Padrino" }
```


Queries are case sensitive. Documents are persisted in a format called [BSON](http://bsonspec.org/), so you can save the same types as you
can with JSON:

- strings: "Hello"
- numbers: 123
- booleans: true|false
- arrays: [1, true, "hello"]
- objects: { 1:2}
- null: null


```sh
db.wands.insert(
  {
    "name": "Dream Bender",
    "creator": "Foxmond",
    "level_required": 10,
    "price": 34.9,
    "powers": ['Fire', 'Love'],
    'damage': {'magic': 4, 'melee': 2}
  }
)
```


And BSON comes with `ObjectId` and `Date` (ISODate).


Mongo supports embedded documents. Using the dot notation to specify the embedded field when searching for a
document.


Validation: Basic rules like no other documents shares the same id, no syntax errors or that documents a less than
16 mb big


## Modifications

`remove()` will delete documents that match the provided query.


```sh
db.frameworks.remove({ "name": "Padrino"})
```


If it match multiple documents, it will delete all them. To delete all documents of a collections just pass curly
braces:


```sh
db.frameworks.remove({})
```


update() can modifiy existing documents and will only applied to the first matching document:


```sh
db.frameworks.update({"name": "Padrino"}, {"$set": { "version": 0.13.2}})
db.frameworks.update({"name": "Padrino"}, {"$set": { "version": 0.13.2}}, {"multi": true})
```


Update operators always starts with a $ sign. Passing the third parameter can specify additional operatotions like
updating multiple documents


Update documents count: use the `$inc` method in a document:


```sh

db.frameworks.update({"name": "Padrino"}, {"$inc": { "count": 1}})
```


When updating a non-existing document, nothing will happen. `upsert()` either updates an existing document or
creates a new one:


```sh
db.frameworks.update({"name": "Padrino"}, {"$set": { "count": 1}}, {"upsert": true})
```


`$unset` can remove specified fields.

```sh
db.wands.update(
  {},
  {"$unset": {"smell": ""}},
  {"multi": true}
)
```


`$rename` can rename specified fields.


```sh
db.wands.update(
  {},
  {"$rename": {"creator": "maker"}},
  {"multi": true}
)
```

Update operators:

- `$max` ... updates if new value is greater than current or inserts if empty
- `$min` ... updates if new value is smaller than current or inserts if empty
- `$mul` ... multiplies the current field value by the specified value, inserts 0 if empty.
- `$pop` ... will remove either the first (1) or last (-1) value of an array
- `$push` ... will add a value to the end of an array
```sh
db.wands.update(
  {"name": "Dream Bender"},
  {"$push": {"powers": "Spell Casting"}}
)
```
- `$addToSet` ... will add a value to the end of an array unless it is already present
```sh
db.wands.update(
  {},
  {"$addToSet": {"powers": "Spell Casting"}},
  {"multi": true}
)
```
- `$pull` ... will remove any instance of value from an array
- `$` ... positional operator don't care about the position in an array
```sh
{"$set": {"powers.$": "Love Burst"}},
```


## Query Operators


Adding a filter: Just seperate them by comma:

```sh
> db.potions.find(
  {
    "vendor": "Padrino",
    "ratings.,strenght": 5
  }
)
```


Comparison operators:

- `$gt` ... greater than
- `$lt` ... less than
- `$gte` ... less greater than or equal to
- `$lte` ... less than or equal to
- `$ne` ... not equal to
```sh
> db.potions.find(
  { "price": { "$lt": 20 }}
)
```

- `$elemMatch` ... make sure at least 1 element in an ray matches all criteria
```sh
> db.potions.find(
  { "price": { "$elemMatch": { "$gt": 8, "$lt": 13}}}
)
```


## Customiting Queries

**projections** can be used as a second parameter of `find()` to specify the exact fields we want bach by setting
their value to true or to false if we don't want to see them.


```sh
> db.potions.find(
  { "price": { "$elemMatch": { "$gt": 8, "$lt": 13}}},
  { "vendor": true, "name": true}
)
```


Whenever you search for documents with `find()` an object is returned called **cursor object** where each of them
contains 20 documents:

- `$sort()` ... sort documents (1 ascending, -1 descending)
```sh
db.wands.find({}, {"name": true}).sort({"name": 1})
```
- `$skip()` and `$limit` can be used for pagination
- `$count()` ... count the total number of results
```sh
db.wands.find({"level_required": 2}).count()
```


## Data Modeling

- **embedding**: single query, documents accessed through parent, atomic writes
- **referencing**: requires 2 queries, document exists independently, don't support multi-document writes, good for
  large data sizes



## Aggregation Apparitions

Allows advanced computations

```sh
db.wands.aggregate([{"$group": {"_id": "$maker"}}])
```

With this you get a list of unique makers


