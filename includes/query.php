<?php
class Query
{
  protected $type     = array(
                              'select' => null,
                              'insert' => null,
                              'update' => null,
                              'delete' => null); // Query type "SELECT, INSERT, etc."
  protected $from     = null; // From for SELECT statment
  protected $where    = null; // Where for SELECT statment
  protected $group    = null; // Group by
  protected $join     = null; // Joining type
  protected $set      = null; // Set for UPDATE statments
  protected $having   = null; // Having
  protected $order    = null; // Order by
  protected $union    = null; // Union
  protected $unionAll = null; // Union All
  protected $query    = null;
  protected $limit    = null;
  protected $offset   = null;

  /**
   * Function for SELECT statment
   * @param array $columns  array of columns to select
   */
  public function select($columns = array("*"))
  {
    $select = implode(",", $columns);
    $this->type['select'] = 'SELECT ' . $select . ' FROM ';
  }
  public function insert($table, $columns = array(), $values = array())
  {
    $cols = implode(",", $columns);
    $val  = implode('","', $values);
    $this->type['insert'] = 'INSERT INTO ' . $table . ' ' . $columns . ' VALUES' . '("'.$val.'")';
  }
  public function delete($from)
  {
    $this->type['delete'] = 'DELETE FROM '. $from;
  }
  public function update($table, $set)
  {
    $this->type['update'] = 'UPDATE ' . $table . ' SET ' . $set;
  }
  /**
   * Function for FROM statment
   * @param array  $table  The table to select form
   * @param array  $as     The alias for the table
   */
  public function from($table = array(), $as = null)
  {
    $from = "";
    $c = count($table);
    for ($i=0; $i < $c; $i++) {
      $from .= $table[$i];
      if($as != null)
      $from .= ' AS ' . $as[$i];
      if ($i != $c-1) {
        $from = $from . ', ';
      }
    }
    $this->from = $from;
  }
  /**
   * Function for JOIN statment
   * @param string  $type   The type of joining
   * @param string  $table  The table to join
   * @param string  $on     The condition of joining
   */
  public function join($type, $table, $on)
  {
    $this->join .= ' ' . $type . ' JOIN ' . $table . ' ON ' . $on;
  }
  /**
   * Function for GROUP BY statment
   * @param string  $column  The column to group by
   */
  public function group($column)
  {
    $this->group = 'GROUP BY ' . $column;
  }
  /**
   * Function for GROUP BY statment
   * @param string  $column  The column to group by
   */
  public function where($condition)
  {
    if($this->where == null)
      $this->where = 'WHERE ' . $condition;
    else
      $this->where = $this->where . ' AND ' . $condition;
  }
  public function having($condition)
  {
    $this->having = 'HAVING ' . $condition;
  }
  public function order_by($column, $direction = null)
  {
    if($this->order = null)
      $this->order = 'ORDER BY ' . $column . ' ' . $direction;
    else
      $this->order = ', ' . $column . ' ' . $direction;
  }
  public function union($query)
  {
    $this->union = $this->union . ' UNION ' . $query;
  }
  public function unionAll($query)
  {
    $this->unionAll = $this->unionAll . ' UNION ALL ' . $query;
  }
  public function full_query($query)
  {
    $this->query = $query;
  }
  public function limit($value)
  {
    $this->limit = 'LIMIT ' . (string)$value;
  }
  public function offset($value)
  {
    $this->offset = 'OFFSET ' . (string)$value;
  }
  public function setQuery()
  {
    if($this->query == null)
    {
      $the_query = array();
      if ($this->type['select'] != null)
      {
         array_push($the_query, $this->type['select']);
         array_push($the_query, $this->from);
         array_push($the_query, $this->join);
         array_push($the_query, $this->where);
         array_push($the_query, $this->limit);
         array_push($the_query, $this->offset);
         array_push($the_query, $this->order);
         array_push($the_query, $this->group);
         array_push($the_query, $this->having);
      }
      if ($this->type['insert'] != null)
      {
        array_push($the_query, $this->type['insert']);
      }
      if ($this->type['update'] != null)
      {
        array_push($the_query, $this->type['update']);
        array_push($the_query, $this->where);
      }
      if ($this->type['delete'] != null)
      {
        array_push($the_query, $this->type['delete']);
        array_push($the_query, $this->where);
      }
      $this->query = implode(' ', $the_query) . ';';
    }
  }
  public function getQuery()
  {
    return $this->query;
  }
}
