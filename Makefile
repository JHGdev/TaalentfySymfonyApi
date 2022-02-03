create-docker:
ifeq ($(wildcard .docker/.env), )
	cp .docker/.env.dev .docker/.env
endif
	$(MAKE) -C .docker all

install:
	$(MAKE) -C symfony_api all

create-test:
	$(MAKE) -C symfony_api/test/ all