run:
	php bin/console server:run

database:
	php bin/console doctrine:database:create

schema:
	php bin/console doctrine:schema:create

fixtures:
	php bin/console doctrine:fixtures:load

