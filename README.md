# Laravel-api
Small API service


Prerequesite: virtualbox
 On Mac and Linux, this file is located at /etc/hosts. On Windows, it is located at  C:\Windows\System32\drivers\etc\hosts
 192.168.10.10 homestead.test


clone

composer install


Mac / Linux:
php vendor/bin/homestead make
Windows:
vendor\\bin\\homestead make


php artisan migrate --seed

tests:
./vendor/bin/phpunit





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

