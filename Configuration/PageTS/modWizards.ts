mod.wizards {
	newContentElement.wizardItems.plugins {
		elements {
			t3sports_stats {
				iconIdentifier = t3sports_plugin
				title = LLL:EXT:t3sportstats/locallang_db.xml:plugin.t3sportstats.label
				description = LLL:EXT:t3sportstats/locallang_db.xml:plugin.t3sportstats.description
				tt_content_defValues {
					CType = list
					list_type = tx_t3sportstats
				}
			}
		}
	}
}
