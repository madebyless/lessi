<?php

namespace Piotrkulpinski\Framework\Config;

/**
 * Class ConfigInterface
 */
interface ConfigInterface {

	/**
	 * Insures that only one instance of Config exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return Config
	 */
	public static function instance();

	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Method that returns project slug.
	 *
	 * Generally used for naming settings, customizer options etc.
	 *
	 * @return string
	 */
	public function getSlug(): string;

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 *
	 * @return string
	 */
	public function getVersion(): string;

	/**
	 * Method that returns project author.
	 *
	 * Used for displaying author on theme settings.
	 *
	 * @return string
	 */
	public function getAuthor(): string;

	/**
	 * Method that returns templates path.
	 *
	 * Used for setting up template paths for Timber views.
	 *
	 * @return string
	 */
	public function getTemplatesPath(): string;

	/**
	 * Method that returns dist path.
	 *
	 * Used for enqueueing static resources.
	 *
	 * @return string
	 */
	public function getDistPath(): string;

	/**
	 * Method that returns assets path.
	 *
	 * Used for displaying static resources like images, fonts etc.
	 *
	 * @return string
	 */
	public function getAssetsPath(): string;

	/**
	 * Method that returns manifest file path.
	 *
	 * Used for reading the production manifest file.
	 *
	 * @return string
	 */
	public function getManifestPath(): string;

	/**
	 * Method that returns manifest dev file path.
	 *
	 * Used for reading the development manifest file.
	 *
	 * @return string
	 */
	public function getManifestDevPath(): string;
}
