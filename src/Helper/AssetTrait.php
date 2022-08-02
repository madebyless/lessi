<?php

namespace MadeByLess\Lessi\Helper;

use MadeByLess\Lessi\Helper\FileTrait;

/**
 * Provides methods to manipulate static asset files
 */
trait AssetTrait {
	use FileTrait;

	/**
	 * Stored manifest JSON file
	 *
	 * @var array|null
	 */
	private ?array $manifest;

	/**
	 * Returns the real path of the asset file.
	 *
	 * @param string $asset Path to the asset file
	 *
	 * @return string
	 */
	public function assetUrl( string $asset ): string {
		return $this->revisionedUrl( $this->getPath( config()->getAssetsPath(), $asset ) );
	}

	/**
	 * Verifies existence of the given file in manifest
	 *
	 * @param string $asset Path to the asset file
	 * @param array|null $manifest Optional. Already fetched manifest object
	 *
	 * @return bool
	 */
	protected function hasFile( string $asset, ?array $manifest = null ): bool {
		$manifest ??= $this->getManifest();

		return is_array( $manifest ) && array_key_exists( $asset, $manifest );
	}

	/**
	 * Returns the real url of the revisioned file.
	 * based on the manifest file content.
	 *
	 * @param string $asset Path to the asset file
	 *
	 * @return string
	 */
	protected function revisionedUrl( string $asset ): string {
		$manifest = $this->getManifest();

		if ( ! $this->hasFile( $asset, $manifest ) ) {
			return 'FILE-NOT-REVISIONED';
		}

		return $this->getTemplateUrl( config()->getDistPath(), $manifest[ $asset ] );
	}

	/**
	 * Checks if request is in development environment
	 *
	 * @return bool
	 */
	private function isDev(): bool {
		return defined( 'THEME_DEV_ENV' );
	}

	/**
	 * Get parsed manifest file content
	 *
	 * @return array|null
	 */
	private function getManifest(): ?array {
		if ( empty( $this->manifest ) ) {
			$this->manifest = $this->fetchManifest();
		}

		return $this->manifest;
	}

	/**
	 * Fetches data from remote manifest file
	 *
	 * @return array|null
	 */
	private function fetchManifest(): ?array {
		$manifestPath = $this->getTemplatePath(
			$this->isDev()
				? config()->getManifestDevPath()
				: config()->getManifestPath()
		);

		if ( file_exists( $manifestPath ) ) {
			return (array) json_decode( file_get_contents( $manifestPath ) );
		}

		return null;
	}
}
