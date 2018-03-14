<?php
namespace common\helpers;
/**
 * Class DateHelper
 * @package common\helpers\helpers
 * 日期处理类
 */
class DateHelper{

	/**
	 * 获取指定日期之间的各个日  时间戳
	 */
	public static function getDaylist($begin,$end){
		$day_arr = array();
		$begin = strtotime(date('Y-m-d',$begin));
		$end = strtotime(date('Y-m-d',$end));
		for($i=$begin; $i<=$end; $i+=(24*3600))
		{
			$day_arr[] = date("Y-m-d",$i);
		}
		return $day_arr;
	}
	/**
	 * 获取指定日期之间的各个时  时间戳
	 */
	public static function getHourList($begin,$end){
		$time_arr = array();
		$begin = strtotime(date('Y-m-d H:00:00',$begin));
		$end = strtotime(date('Y-m-d H:00:00',$end));
		for($i=$begin; $i<=$end; $i+=(1*3600))
		{
			$time_arr[] = date("Y-m-d H",$i);
		}
		return $time_arr;
	}

	/**
	 * 参数是否是日期格式
	 * @param   $ymd: 日期字符串
	 * @param   $sep: 日期分隔符
	 * @return  bool
	 */
	public static function isDate($ymd, $sep = '-') {
		$tmp = explode($sep, $ymd);
		if (count($tmp) != 3) {
			return false;
		}
		$tmp = array_map('intval', $tmp);
		list($year, $month, $day) = $tmp;
		return checkdate($month, $day, $year);
	}

	/**
	 * 格式化时间戳为普通日期格式
	 * @param   $time_stamp: 时间戳
	 * @param   $format: 日期格式
	 * @return  string
	 */
	public static function format($time_stamp, $format = 'Y-m-d') {
		return date($format, $time_stamp);
	}

	/**
	 * 当天零点的时间戳或者日期
	 */
	public static function today($time_stamp = null, $format = null) {
		if ($time_stamp === null) {
			$time_stamp = time();
		}
		$today = strtotime(self::format($time_stamp));
		return $format === null ? $today : self::format($today, $format);
	}

	/**
	 * 明天零点的时间戳或者日期
	 */
	public static function tomorrow($format = null) {
		$tomorrow = self::today() + 86400;
		return $format === null ? $tomorrow : self::format($tomorrow, $format);
	}

	/**
	 * 昨天零点的时间戳或者日期
	 */
	public static function yesterday($format = null) {
		$yesterday = self::today() - 86400;
		return $format === null ? $yesterday : self::format($yesterday, $format);
	}

	/**
	 * 根据输入时间戳，返回其当月的第一天和最后一天的时间戳或日期
	 */
	public function month($time_stamp, $format = null) {
		$year_month = self::format($time_stamp, 'Y-n');
		list($year, $month) = explode('-', $year_month);

		$feb_days = $year % 4 == 0 ? 29 : 28;
		$days = [0, 31, $feb_days, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

		$month_start = mktime(0, 0, 0, $month, 1, $year);
		$month_end = $month_start + ($days[$month] - 1) * 86400;

		if ($format !== null) {
			$month_start = self::format($month_start, $format);
			$month_end = self::format($month_end, $format);
		}

		return [$month_start, $month_end];
	}

	/**
	 * 两个时间戳相差的天数
	 */
	public static function dayDiff($timestamp1, $timestamp2)
	{
		return floor(($timestamp1 - $timestamp2) / 86400);
	}
}