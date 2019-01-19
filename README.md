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



Issue:
Check your Homestead.yaml file, the path to your private key does not exist.

touch ~/.ssh/id_rsa

issue:
ash: line 5: /sbin/ifdown: No such file or directory
bash: line 19: /sbin/ifup: No such file or directory

vagrant ssh
apt-get install ifupdown


