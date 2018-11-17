# Basic Pricing API

This project represents an API which can be used in order to retrieve some products and get the cost
for a specific amount requested.

The API code is in the ```PricingAPI``` folder, and can be used alone, however around it there is a
docker compose file and a docker folder which can be used in order to create a running environment
with the correct version of PHP.

In order to run the service ```composer install``` must be run, if is needed to run it from the
container it should then be installed with teh required dependencies.

The dependencies are curl and a set of php extensions like mysql, zip, mbr.

The framework used is Symfony versipon 4 but this project is quite a draft so hasn't been used any
specific recomendetion for file structure if not what was produced by the skeleton app.

The database schema and sample data are available in the sql folder.

The structure is defined as such:

Products table has got only ID, Name, Description. No pricing is defined for it, no special rule is
defined.

Units represents teh measurement units, apples can be sold by the item or by the kg, so one unit is
the "item" and another is "kg". Any sort of unit can be defined and added to the database.

Amounts represents the minimum batch which can be sold. If we want to sell apple by the item we have
an amount called "item" which reresents one apple. if we sell apples by the couple, we can see there
is an amount called "couple" we can define dozen or any otehr amount. An amount depends on an unit
so for example a "tonne" is an amount we might sell apples and is defined as 1000 units of teh unit
kg.

Prices represents the actual prices, it has a value in the current currency (assumed i.e. GBP), 
there is a relation with a product, one with an amount and a value.

We can set a price per item for apples, a price per doze, and a price per kg.

If we call the API at the url:

```/products```

we can see that a set of products gets returned, each product contains severl prices, which belong
to an amount. From this we could display in a website different purchase options:

by apples by the kg
by apples by teh dozen
by apples by item

it is possible to see one specific product at
```/product/1```

whith the detailed infos for the product.
The system should be tuned so that unneeded information doe snot appear when requesting the list
but I was not familiar with the new version of Doctrine as it was ages I wasn't using it. This is
something to improve.

If we want to get the cost for a purchase we can call:

```/cost/{productid}/{amountid}/{amount}```

Say 1 is apple
Say 4 is a couple
then ```/cost/1/4/3``` will get the price for three couples of apples

It is possible so to specify prices for things like:

a bag with 3 apples for 1GBP

Now we need to apply some discounts

Discounts is a table which is totally independent from the products, amounts or anything else
already seen.

A discount has a name like "3 4 2" or "half price", then it has a type, which is an enumeration
which can be:
amount
fixed
percent

If we define a discount "half price" as percent with value "50" and qty "20" this means that we
remove 50% from the price of 20 "amount".

So if we apply this discount to the price of apples per couple, we can then find put that
the price for 20 couples of appples will be the same as teh one for 10 couples.

If we apply teh same discount on some price by the gram, then 20 grams will cost like 10.

This adds flexibility so we can reuse the same discounts.

The way to add an actual discount to a price is with a linking table: products_discounts

This table is essentially applying discounts to a price, which is applied to an amount for
a product.


The PHP code is not making use of services but for the moment is just adding everything in the
controller, which calls the repositories to get the data.

Code should be broken and arranged differently but it took me 4 hours just to set up the framework
as I was using an old one not maintained any more and didn't have a working environment. Decided
at the end to install and try the new version.