<?php

	namespace App\Tests;

	use PHPUnit\Framework\TestCase;

	class ClassToTest extends TestCase {
		private $locale;
		private $host;
		private $scheme;
		private $proxy;

		public function setUp()
		{
			parent::setUp();

			$this->locale = $_SERVER['LOCALE'];
			$this->host = $_SERVER['HOST'];
			$this->scheme = $_SERVER['SCHEME'];
			$this->proxy = $_SERVER['PROXY'];
		}

		public function testItShouldWork()
		{
			$this->assertEquals('fr', $this->locale);
		}
	}
