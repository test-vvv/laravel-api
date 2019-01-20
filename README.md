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
4. Start VM:
> vagrant up

5. Run migrations and seed tables:

> php artisan migrate:refresh --seed

6. Run tests(tests/Feature/):
> ./vendor/bin/phpunit


Endpoints:
---
#### POST: http://192.168.10.10/api/products

Put new product to a DB

Example request data for testing:
```json
{
    "color": "1",
    "product_type": "1",
    "size": "21",
    "price": "12"
}
```

Example response:
```json
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

#### GET: http://192.168.10.10/api/orderDrafts

List all order drafts

Example response:
```json
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

#### GET: http://192.168.10.10/api/orderDrafts/{productType}

List order drafts by product type

Example request:

http://192.168.10.10/api/orderDrafts/Notebook

Example response:
```json
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

#### GET: http://192.168.10.10/api/orderDraft/calculate

Get total price, save order draft in DB

Example request:
```json
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
```json
{
    "error": "Total price is too low"
}
```

Example request:
```json
{
    "data": {
	    "products": [
            {
                "product_id": 1,
                "qty": 10
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
```json
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


