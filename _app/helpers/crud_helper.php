<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

    //READ
if( ! function_exists( 'get_data' ) ) {
    function get_data($param, $is_array = false) {
        /*
			$param['table'] 		-> string or array
			$param['select']		-> string
			$param['where']			-> array
			$param['group_by']		-> string
			$param['order_by']		-> string
			$param['not_in']		-> array
			$param['limit']			-> int
			$param['offset']		-> int
        */
        // SELECT
        $CI = & get_instance();
        if ( ! empty( $param['select'] ) ) {
			$CI->db->select( $param['select'], false );
        }

        // FROM
        if( is_array( $param['table'] ) ) {
            $n = 1;
            foreach ( $param['table'] as $tab => $on ) {
                if ( $n > 1 ) {
					if ( is_array( $on ) ) {
						$CI->db->join( $tab, $on[0], $on[1] );
					} else {
						$CI->db->join( $tab, $on );
					}
				} else {
					$CI->db->from( $tab );
				}
                $n++;
            }   
        }
        else {
			$CI->db->from( $param['table'] );
        }
        
        // WHERE
		if ( ! empty( $param['where'] ) ) {
			foreach( $param['where'] as $w => $an ) {
				if ( is_null( $an ) ){
					$CI->db->where( $w, null, false );
				}else {
					$CI->db->where( $w, $an );
				}
			}
		}

        		// OR WHERE
		if ( ! empty( $param['or_where'] ) ) {
			foreach( $param['or_where'] as $w => $an ) {
				if ( is_null( $an ) ){
					$CI->db->or_where( $w, null, false );
				}else {
					$CI->db->or_where( $w, $an );
				}
			}
		}

		// NOT IN
		if ( ! empty( $param['not_in'] ) ) {
			if ( is_array( $param['not_in'] ) ) {
				foreach( $param['not_in'] as $w => $an ) {
					if ( is_null( $an ) ) {
						$CI->db->where_not_in( $w, null, false );
					}else {
						$CI->db->where_not_in( $w, $an );
					}
				}
			} else {
				$CI->db->where_not_in($param['not_in'],$param['not_in_isi']);
			}
		}

		// LIMIT, OFFSET
		if ( ! empty( $param['limit'] ) && ! empty( $param['offset'] ) ) {
			$CI->db->limit( $param['limit'], $param['offset'] );
		} else if ( ! empty( $param['limit'] ) && empty( $param['offset'] ) ) {
			$CI->db->limit( $param['limit'] );
		}

		// LIKE
		if ( ! empty( $param['like'] ) ) {
			$srch = [];
			foreach( $param['like'] as $sc => $vl ) {
				if ( $vl != NULL ) $srch[] = $sc . " LIKE '%" . $vl . "%'";
			}

			if ( count( $srch ) > 0 ) $CI->db->where( '(' . implode(' OR ', $srch ) . ')', null, false );

		}

		// ORDER_BY
		if ( ! empty( $param['order_by'] ) ) {
			$CI->db->order_by( $param['order_by'] );
		}

		// GROUP_BY
		if ( ! empty( $param['group_by'] ) ) {
			$CI->db->group_by( $param['group_by'] );
		}
        $query = $CI->db->get();

		return ( ( $is_array ) ? $query->result_array() : $query ) ;
    }
}

// CREATE, EDIT
if ( ! function_exists( 'save_data' ) ) {
    function save_data( $table, $data = null, $where = null ) {
        $CI = & get_instance();
        if ( is_array( $table ) ) {
            if ( ! empty( $table['where'] ) ) {
                $CI->db->where( $table['where'] );
                if ( array_key_exists( 'set', $table ) ) {
                    foreach ( $table['set'] as $col => $val ) {
                        if ( is_array( $val ) ) {
                            $CI->db->set( $col, $val[0], $val[1] );
                        } else {
                            $CI->db->set( $col, $val );
                        }
                    }
                    $CI->db->update( $table['table'] );
                } else {
                    $CI->db->update( $table['table'], $table['data'] );
                }
                $id_save = $CI->db->affected_rows();
            } else {
                if ( array_key_exists( 'set', $table ) ) {
                    foreach ( $table['set'] as $col => $val ) {
                        $CI->db->set( $col, $val );
                    }
                    $CI->db->insert( $table['table'] );
                } else {
                    $CI->db->insert( $table['table'], $table['data'] );
                }
                $id_save = $CI->db->insert_id();
            }
        } else {
            if ( ! empty( $where ) ) {
                if ( is_array( $where ) ) {
                    if ( count( $where ) > 1 ) {
                        foreach ( $where as $col => $val ) {
                            $CI->db->where( $col, $val );
                        }
                    } else {
                        $CI->db->where( $where );
                    }
                } else {
                    $CI->db->where( $where );
                }
                $CI->db->update( $table, $data );
                $id_save = $CI->db->affected_rows();
            } else {
                $CI->db->insert( $table, $data );
                $id_save = $CI->db->insert_id();
            }
        }

        return $id_save;
    }
}

// DELETE
if ( ! function_exists( 'delete_data' ) ) {
    function delete_data( $tabel, $column = null, $id = null) {
        $CI = & get_instance();
        if ( is_array( $tabel ) ) {
            foreach( $tabel['where'] as $w => $an ) {
                if ( is_null( $an ) ) $CI->db->where( $w, null, false );
                else $CI->db->where( $w, $an );
            }
            return $CI->db->delete( $tabel['table'] );
        } else {
            if ( ! empty( $column ) ) {
                if ( is_array( $column ) ) $CI->db->where( $column );
                else $CI->db->where( $column, $id );
            }
            return $CI->db->delete( $tabel );
        }
    }
}

// Query sql
if ( ! function_exists( 'data_query' ) ) {
    function data_query( $sql = null ){
        $CI 	= & get_instance();
        return $CI->db->query( $sql );
    }
}

// Datatable
if ( ! function_exists( 'get_datatable' ) ) {
    function get_datatable( $params, $type = 'POST' ) {
        $CI = & get_instance();
        $in = ( ( $type == 'POST' ) ? $_POST : $_GET );

        $where = 'WHERE 1';
        foreach ( $in['columns'] as $k => $col ) {
            if ( (bool)$col['searchable'] ) {
                if ( $col['search']['value'] != '' || $col['search']['value'] != null ) {
                    $where .= " AND " . ( $col['data'] ) . " LIKE '%" . ( $col['search']['value'] ) . "%'";
                }
            }
        }

        if ( $where == 'WHERE 1' ) {
            if ( $in['search']['value'] != '' ) {
                $w = 1;
                foreach ( $in['columns'] as $key => $val ) {
                    if ( $val['searchable'] == 'true' ) {
                        $where .= " " . ( ( $w == 1 ) ? "AND" : "OR" ) . " {$val['data']} LIKE '%{$in['search']['value']}%'";
                        $w++;
                    }
                }
            }
        }

        $order_by = 'ORDER BY ';
        $jml = count( $in['order'] );
        if ( $jml > 1 ) {
            foreach ( $in['order'] as $key => $val ) {
                $col = $val['column'];
                $order_by .= $in['columns'][$col]['data'] . " " . $val['dir'] . ( ( $key+1 == $jml ) ? "" : ", " );
            }
        } else {
            $order_by .= $in['order'][0]['column'] . " " .$in['order'][0]['dir'];
        }

        $join = null;
        if ( array_key_exists( 'join', $params['sub'] ) ) {
            if ( is_array( $params['sub']['join'] ) ) {
                foreach ( $params['sub']['join'] as $tab => $on ) {
                    $join .= " " . ( ( is_array( $on ) ) ? $on[1] : '' ) . " JOIN {$tab} ON " . ( ( is_array( $on ) ) ? $on[0]  : $on );
                }
            } else {
                $join = $params['sub']['join'];
            }
        }
        $limit = ( ( $in['length'] > 0 ) ? "LIMIT {$in['start']}, {$in['length']}" : '' );
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS * FROM (
                SELECT " . ( ( array_key_exists( 'select', $params ) ) ? $params['select'] : '*' ) . "
                FROM (
                    SELECT " . ( ( array_key_exists( 'select', $params['sub'] ) ) ? $params['sub']['select'] : '*' ) . "
                    FROM {$params['table']}
                    {$join}
                    WHERE 1 " . ( ( array_key_exists( 'where', $params['sub'] ) ) ? ' AND ' . $params['sub']['where'] : '' ) . " " .
                    ( ( array_key_exists( 'group_by', $params['sub'] ) ) ? 'GROUP BY ' . $params['sub']['group_by'] : '' ) . "
                ) result

            ) tabel
            {$where} " .
            ( ( array_key_exists( 'group_by', $params ) ) ? 'GROUP BY ' . $params['group_by'] : '' ) . "
            {$order_by}
            {$limit}"
        ;
        // disp( $sql );

        $output['data'] = $CI->db->query( $sql );
        $output['total'] = $CI->db->query('SELECT FOUND_ROWS() as total')->row( 'total' );
        return $output;
    }
}
    