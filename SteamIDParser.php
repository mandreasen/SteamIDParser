<?php

class SteamIDParser
{
	/**
	* @param string $accountid Steam AccountID
	* @return string SteamID3 ([U:1:Z])
	*/
	public function AccountID2SteamID3($accountid)
	{
		return "[U:1:".$accountid."]";
	}

	/**
	* @param integer $accountid Steam AccountID
	* @return string STEAM_X:Y:Z
	*/
	public function AccountID2SteamID($accountid)
	{
		if (($accountid % 2) == 0) {
			$Y = 0;
			$Z = ($accountid / 2);
		} else {
			$Y = 1;
			$Z = (($accountid - 1) / 2);
		}

		return "STEAM_0:".$Y.":".$Z;
	}

	/**
	* @param integer $accountid Steam AccountID
	* @return string SteamID64
	*/
	public function AccountID2SteamID64($accountid)
	{
		if (($accountid % 2) == 0) {
			$Y = 0;
			$Z = ($accountid / 2);
		} else {
			$Y = 1;
			$Z = (($accountid - 1) / 2);
		}

		return "7656119".(($Z * 2) + (7960265728 + $Y));
	}

	/**
	* @param string $steamid STEAM_X:Y:Z
	* @return integer Steam AccountID
	*/
	public function SteamID2AccountID($steamid)
	{
		$args = explode(":", $steamid);
		$Y = $args[1];
		$Z = $args[2];

		return ($Z * 2) + $Y;
	}

	/**
	* @param string $steamid STEAM_X:Y:Z
	* @return string 7656119XXXXXXXXXX (SteamID64)
	*/
	public function SteamID2SteamID64($steamid)
	{
		$args = explode(":", $steamid);
		$Y = $args[1];
		$Z = $args[2];

		return "7656119".(($Z * 2) + (7960265728 + $Y));
	}

	/**
	* @param string $steamid STEAM_X:Y:Z
	* @return string SteamID3 ([U:1:Z])
	*/
	public function SteamID2SteamID3($steamid)
	{
		$accountid = $this->SteamID2AccountID($steamid);

		return "[U:1:".$accountid."]";
	}

	/**
	* @param string|integer $steamid64 SteamID64
	* @return integer Steam AccountID
	*/
	public function SteamID642AccountID($steamid64)
	{
		$steamid64 = substr($steamid64, 7);
		
		return ($steamid64 - 7960265728);
	}

	/**
	* @param string|integer $steamid64 SteamID64
	* @return integer SteamID
	*/
	public function SteamID642SteamID($steamid64)
	{
		$accountid = $this->SteamID642AccountID($steamid64);

		return $this->AccountID2SteamID($accountid);
	}

	/**
	* @param string $steamid64 (7656119XXXXXXXXXX)
	* @return string SteamID3 ([U:1:Z])
	*/
	public function SteamID642SteamID3($steamid64)
	{
		$accountid = $this->SteamID642AccountID($steamid64);

		return "[U:1:".$accountid."]";
	}

	/**
	* @param string $steamid3 [U:1:Z]
	* @return integer Steam AccountID
	*/
	public function SteamID32AccountID($steamid3)
	{
		$args = explode(":", $steamid3);
		
		return substr($args[2], 0, -1);
	}

	/**
	* @param string $steamid3 [U:1:Z]
	* @return string SteamID
	*/
	public function SteamID32SteamID($steamid3)
	{
		$accountid = $this->SteamID32AccountID($steamid3);

		return $this->AccountID2SteamID($accountid);
	}

	/**
	* @param string $steamid3 [U:1:Z]
	* @return string SteamID64
	*/
	public function SteamID32SteamID64($steamid3)
	{
		$accountid = $this->SteamID32AccountID($steamid3);

		return $this->AccountID2SteamID64($accountid);
	}
}

?>