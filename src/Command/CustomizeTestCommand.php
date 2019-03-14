<?php

	namespace App\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;

	class CustomizeTestCommand extends Command {
		protected static $defaultName = 'customize:test';

		private const LOCALE = 'locale';
		private const DOTENV_LOCALE = '<LOCALE>';

		private const HOST = 'host';
		private const DOTENV_HOST = '<HOST>';

		private const SCHEME = 'scheme';
		private const DOTENV_SCHEME = '<SCHEME>';

		private const PROXY = 'proxy';
		private const DOTENV_PROXY = '<PROXY>';

		private const DIST_FILE = '.env.test.dist';
		private const ENV_FILE = '.env.test';

		protected function configure()
		{
			$this->setDescription('This is an abstract of phpunit in order to set custom parameters for different environments');

			$this
				->addOption(self::LOCALE, '-l', InputOption::VALUE_OPTIONAL, 'Test language (locale)')
				->addOption(self::HOST, '-u', InputOption::VALUE_OPTIONAL, 'Project url (host)')
				->addOption(self::SCHEME, '-s', InputOption::VALUE_OPTIONAL, 'Scheme (http | https)')
				->addOption(self::PROXY, '-p', InputOption::VALUE_OPTIONAL, 'Proxy');
		}

		private function getAllEnvVars()
		{
			return [
				self::PROXY => self::DOTENV_PROXY,
				self::HOST => self::DOTENV_HOST,
				self::SCHEME => self::DOTENV_SCHEME,
				self::LOCALE => self::DOTENV_LOCALE,
			];
		}

		protected function execute(InputInterface $input, OutputInterface $output)
		{
			// copy env.test.dist
			exec(sprintf('cp -R %s %s', self::DIST_FILE, self::ENV_FILE));

			// update env file content
			$envFileContent = file_get_contents(self::ENV_FILE);
			foreach ($this->getAllEnvVars() as $commandOption => $envVarName) {
				$envFileContent = str_replace($envVarName, $input->getOption($commandOption) ?? '', $envFileContent);
			}
			file_put_contents(self::ENV_FILE, $envFileContent);
		}
	}
