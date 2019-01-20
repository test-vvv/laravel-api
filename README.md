# Laravel-api
Small API service


Prerequesites:
---
#### The stuff that need to be installed:
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



Issue:
Check your Homestead.yaml file, the path to your private key does not exist.

touch ~/.ssh/id_rsa

issue:
ash: line 5: /sbin/ifdown: No such file or directory
bash: line 19: /sbin/ifup: No such file or directory

vagrant ssh

apt-get install ifupdown

vagrant reload

