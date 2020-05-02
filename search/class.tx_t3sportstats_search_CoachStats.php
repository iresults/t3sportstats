<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2017 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/
tx_rnbase::load('tx_rnbase_util_SearchBase');

/**
 * Class to search player stats from database.
 *
 * @author Rene Nitzsche
 */
class tx_t3sportstats_search_CoachStats extends tx_rnbase_util_SearchBase
{
    protected function getTableMappings()
    {
        $tableMapping = [];
        $tableMapping['COACHSTAT'] = 'tx_t3sportstats_coachs';
        $tableMapping['COACH'] = 'tx_cfcleague_profiles';
        $tableMapping['MATCH'] = 'tx_cfcleague_games';
        $tableMapping['COMPETITION'] = 'tx_cfcleague_competition';
        $tableMapping['CLUB'] = 'tx_cfcleague_club';
        $tableMapping['CLUBOPP'] = 'tx_cfcleague_club';
        // Hook to append other tables
        tx_rnbase_util_Misc::callHook('t3sportstats', 'search_CoachStats_getTableMapping_hook', array(
            'tableMapping' => &$tableMapping,
        ), $this);

        return $tableMapping;
    }

    protected function useAlias()
    {
        return true;
    }

    protected function getBaseTableAlias()
    {
        return 'COACHSTAT';
    }

    protected function getBaseTable()
    {
        return 'tx_t3sportstats_coachs';
    }

    public function getWrapperClass()
    {
        return 'tx_t3sportstats_models_CoachStat';
    }

    protected function getJoins($tableAliases)
    {
        $join = '';
        if (isset($tableAliases['MATCH'])) {
            $join .= ' JOIN tx_cfcleague_games AS MATCH ON COACHSTAT.t3match = MATCH.uid ';
        }
        if (isset($tableAliases['COACH'])) {
            $join .= ' JOIN tx_cfcleague_profiles AS COACH ON COACHSTAT.coach = COACH.uid ';
        }
        if (isset($tableAliases['COMPETITION'])) {
            $join .= ' JOIN tx_cfcleague_competition AS COMPETITION ON COMPETITION.uid = COACHSTAT.competition ';
        }
        if (isset($tableAliases['CLUB'])) {
            $join .= ' JOIN tx_cfcleague_club AS CLUB ON CLUB.uid = COACHSTAT.club ';
        }
        if (isset($tableAliases['CLUBOPP'])) {
            $join .= ' JOIN tx_cfcleague_club AS CLUBOPP ON CLUBOPP.uid = COACHSTAT.clubopp ';
        }

        // Hook to append other tables
        tx_rnbase_util_Misc::callHook('t3sportstats', 'search_CoachStats_getJoins_hook', array(
            'join' => &$join,
            'tableAliases' => $tableAliases,
        ), $this);

        return $join;
    }
}
