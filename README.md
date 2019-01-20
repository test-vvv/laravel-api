# Laravel-api
Small API service


Prerequesites:
---
#### The stuff needs to be installed:
1. Virtualbox
2. Vagrant
3. Composer

#### Project installation:
---
1. clone
2. composer install
3. Configure homeastead:

  Mac / Linux: 
  >php vendor/bin/homestead make 
  
  Windows: 
  >vendor\\\bin\\\homestead make

Open Homestead.yaml and add php version:
```
sites:
    -
        map: homestead.test
        to: /home/vagrant/code/public
        php: "7.2"   // <- set this version to avoid known laravel bug
```
4. Run migrations and seed tables:

> php artisan migrate:refresh --seed

5. Run tests(tests/Feature/):
> ./vendor/bin/phpunit


Endpoints:
---
#### POST: api/products

Put new product to a DB

Example request data for testing:
```
{
    "color": "1",
    "product_type": "1",
    "size": "21",
    "price": "12"
}
```

Example response:
```
{
    "color": "1",
    "product_type": "1",
    "size": "21",
    "price": "12",
    "updated_at": "2019-01-20 00:18:55",
    "created_at": "2019-01-20 00:18:55",
    "id": 7
}
```

#### GET: api/orderDrafts

List all order drafts

Example response:
```
{
    "data": [
        {
            "1": [
                {
                    "qty": 1,
                    "product": {
                        "id": 1,
                        "product_type": "Tablet",
                        "color": "olive",
                        "size": "eum",
                        "price": "1.11"
                    }
                }
            ],
            "draft_order_id": 1,
            "country_code": "GB"
        },
        {
            "2": [
                {
                    "qty": 5,
                    "product": {
                        "id": 2,
                        "product_type": "Notebook",
                        "color": "aqua",
                        "size": "soluta",
                        "price": "2.54"
                    }
                },
                {
                    "qty": 1,
                    "product": {
                        "id": 1,
                        "product_type": "Tablet",
                        "color": "olive",
                        "size": "eum",
                        "price": "1.11"
                    }
                }
            ],
            "draft_order_id": 2,
            "country_code": "DE"
        },
        {
            "3": [
                {
                    "qty": 6,
                    "product": {
                        "id": 5,
                        "product_type": "Desktop",
                        "color": "yellow",
                        "size": "tempora",
                        "price": "6.58"
                    }
                }
            ],
            "draft_order_id": 3,
            "country_code": "US"
        },
        {
            "4": [
                {
                    "qty": 20,
                    "product": {
                        "id": 1,
                        "product_type": "Tablet",
                        "color": "olive",
                        "size": "eum",
                        "price": "1.11"
                    }
                },
                {
                    "qty": 2,
                    "product": {
                        "id": 2,
                        "product_type": "Notebook",
                        "color": "aqua",
                        "size": "soluta",
                        "price": "2.54"
                    }
                }
            ],
            "draft_order_id": 4,
            "country_code": "US"
        }
    ]
}
```

#### GET: api/orderDrafts/{productType}

List order drafts by product type

Example request:

api/orderDrafts/Notebook

Example response:
```
{
    "data": [
        {
            "2": [
                {
                    "qty": 5,
                    "product": {
                        "id": 2,
                        "product_type": "Notebook",
                        "color": "aqua",
                        "size": "soluta",
                        "price": "2.54"
                    }
                },
                {
                    "qty": 1,
                    "product": {
                        "id": 1,
                        "product_type": "Tablet",
                        "color": "olive",
                        "size": "eum",
                        "price": "1.11"
                    }
                }
            ],
            "draft_order_id": 2,
            "country_code": "DE"
        },
        {
            "4": [
                {
                    "qty": 20,
                    "product": {
                        "id": 1,
                        "product_type": "Tablet",
                        "color": "olive",
                        "size": "eum",
                        "price": "1.11"
                    }
                },
                {
                    "qty": 2,
                    "product": {
                        "id": 2,
                        "product_type": "Notebook",
                        "color": "aqua",
                        "size": "soluta",
                        "price": "2.54"
                    }
                }
            ],
            "draft_order_id": 4,
            "country_code": "US"
        }
    ]
}
```

#### GET: api/orderDraft/calculate

Get total price, save order draft in DB

Example request:
```
{
	"data": {
		"products": [
			{
				"product_id": 1,
				"qty": 1
			},
			{
				"product_id": 2,
				"qty": 2
			}
		]
	}
}
```

Example response:
```
{
    "error": "Total price is too low"
}
```

Example request:
```
{
	"data": {
		"products": [
			{
				"product_id": 10,
				"qty": 1
			},
			{
				"product_id": 2,
				"qty": 2
			}
		]
	}
}
```

Example response:
```
{
    "data": {
        "Total price": 16.18
    }
}
```


Possible issues:
---

I have faced some issues while testing project instalation on linux.

Issue:

"Check your Homestead.yaml file, the path to your private key does not exist."

Solution:

>touch ~/.ssh/id_rsa

or generate ssh

Issue:
```
ash: line 5: /sbin/ifdown: No such file or directory
bash: line 19: /sbin/ifup: No such file or directory
```

Solution:
```
vagrant ssh

apt-get install ifupdown
exit

vagrant reload
```


