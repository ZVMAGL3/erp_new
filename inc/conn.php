<?php
	class Database {
		private static $instance;
		private $connection;

		public function __construct($dbconfig) {
			$this->connection = mysqli_connect(
				$dbconfig["host"],
				$dbconfig["username"],
				$dbconfig["password"],
				$dbconfig["database"]
			);
	
			if (!$this->connection) {
				throw new Exception("DB连接失败: " . mysqli_connect_error());
			} else {
				$this->connection->set_charset("utf8"); // 数据库编码
				mysqli_autocommit($this->connection, false); // 关闭自动提交
			}
		}
		
		public function query($sql, $params = array(), $types = "") {
			$stmt = mysqli_prepare($this->connection, $sql);
			if ($stmt) {
				if (!empty($params)) {
					$paramCount = count($params);
					if ($types === "") {
						$types = str_repeat('s', $paramCount); // 默认为字符串类型
					}
		
					// 准备绑定参数的数组，第一个元素为预处理语句，第二个元素为类型字符串
					$bindParams = array($stmt, $types);
		
					// 将参数的引用添加到绑定参数数组中
					foreach ($params as $key => $_) {
						$bindParams[] = &$params[$key];
					}
		
					// 使用 call_user_func_array 来动态调用 mysqli_stmt_bind_param
					call_user_func_array("mysqli_stmt_bind_param", $bindParams);
				}
				try {
					// 执行预处理语句
					$result = mysqli_stmt_execute($stmt);

					if ($result) {
						// 获取结果集对象
						$result_set = mysqli_stmt_get_result($stmt);
						// 关闭预处理语句
						mysqli_stmt_close($stmt);
						return array(
							'result' => $result_set,
							'error' => null,
						);
					} else {					
						return array(
							'result' => null,
							'error' => 'Query failed: ' . mysqli_stmt_error($stmt)
						);
					}
				} catch (Exception $e) {
					return '处理数据库语句出现错误';
				}

			} else {
				return array(
					'result' => null,
					'error' => mysqli_error($this->connection)
				);
			}
		}

		public static function getInstance($database) {
			if (!self::$instance) {
				self::$instance = new Database($database);
			}
			return self::$instance;
		}
	
		public function getConnection() {
			return $this->connection;
		}

		public function fetchArray($result) {
			// 获取查询结果的数组形式
			return mysqli_fetch_array($result);
		}

		public function numRows($result) {
			// 获取查询结果的行数
			return mysqli_num_rows($result);
		}

		public function getLastInsertId() {
			// 使用 mysqli_insert_id 获取最后插入的自增ID
			return mysqli_insert_id($this -> connection);
		}

		public function escapeString($str) {
			// 转义字符串中的特殊字符
			return mysqli_real_escape_string($this->connection, $str);
		}

		/**
		 * 开始事务
		 * 使用该方法开始一个数据库事务。在事务中的所有数据库操作要么全部成功提交，要么全部失败回滚。
		 */
		public function beginTransaction() {
			mysqli_begin_transaction($this->connection);
		}

		/**
		 * 提交事务
		 * 使用该方法提交数据库事务。如果在事务中的所有数据库操作都成功执行，调用该方法将保存更改。
		 */
		public function commit() {
			mysqli_commit($this->connection);
		}

		/**
		 * 回滚事务
		 * 使用该方法回滚数据库事务。如果在事务中的任何地方发生错误，可以调用该方法将取消事务中的所有更改。
		 */
		public function rollback() {
			mysqli_rollback($this->connection);
		}

		public function __destruct() {
			if ($this->connection) {
				// 检查连接是否已关闭
				if (mysqli_ping($this->connection)) {
					// 如果连接仍然可用，关闭数据库连接
					mysqli_close($this->connection);
				}
			}
		}
	}
?>