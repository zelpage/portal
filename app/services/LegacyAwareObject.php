<?php

	namespace ZelPage;

	trait LegacyAwareObject {

		protected static function expandTypes(int $type): array {
			$types = [];
			foreach ([1, 2, 4, 8, 16, 32, 1024, 2048, 4096, 8192, 16384] as $i) {
				if ($type & $i) { $types[] = $i; }
			}
			return $types;
		}

		protected static function zipTypes(array $types): int {
			$type = 0;
			foreach ($types as $t) { $type |= $t; }
			return $type;
		}

	}
