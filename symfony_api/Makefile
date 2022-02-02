all:
	composer install
	bin/console doctrine:migrations:migrate
	symfony server:start
