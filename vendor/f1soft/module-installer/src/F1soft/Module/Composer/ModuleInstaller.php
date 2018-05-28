<?php
namespace F1soft\Module\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;


class ModuleInstaller extends LibraryInstaller{
	/**
	 * {@inheritDoc}
	 */
	public function getInstallPath(PackageInterface $package)
	{
		$prefix = substr($package->getPrettyName(), 0, 13);
		if ('f1cms-module/' !== $prefix) {
			throw new \InvalidArgumentException(
					'Unable to install module, module names '
					.'should always start their package name with '
					.'"f1cms-module/"'
			);
		}
	
		return 'application/modules/'.substr($package->getPrettyName(), 13);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return 'f1cms-module' === $packageType;
	}
}
