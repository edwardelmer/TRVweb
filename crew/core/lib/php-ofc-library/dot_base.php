<?php

/**
 * A private class. All the other line-dots inherit from this.
 * Gives them all some common methods.
 */ 
class dot_base
{
	/**
	 * @param $type string
	 * @param $value integer
	 */
	public function __construct($type, $value=null)
	{
		$this->type = $type;
		if( isset( $value ) )
			$this->value( $value );
	}
	
	/**
	 * For line charts that only require a Y position
	 * for each point.
	 * @param $value as integer, the Y position
	 */
	public function value( $value )
	{
		$this->value = $value;
	}
	
	/**
	 * For scatter charts that require an X and Y position for
	 * each point.
	 * 
	 * @param $x as integer
	 * @param $y as integer
	 */
	public function position( $x, $y )
	{
		$this->x = $x;
		$this->y = $y;
	}
	
	/**
	 * @param $colour is a string, HEX colour, e.g. '#FF0000' red
	 */
	public function colour($colour)
	{
		$this->colour = $colour;
		return $this;
	}
	
	/**
	 * The tooltip for this dot.
	 */
	public function tooltip( $tip )
	{
		$this->tip = $tip;
		return $this;
	}
	
	/**
	 * @param $size is an integer. Size of the dot.
	 */
	public function size($size)
	{
		$tmp = 'dot-size';
		$this->$tmp = $size;
		return $this;
	}
	
	/**
	 * a private method
	 */
	public function type( $type )
	{
		$this->type = $type;
		return $this;
	}
	
	/**
	 * @param $size is an integer. The size of the hollow 'halo' around the dot that masks the line.
	 */
	public function halo_size( $size )
	{
		$tmp = 'halo-size';
		$this->$tmp = $size;
		return $this;
	}
	
	/**
	 * @param $do as string. One of three options (examples):
	 *  - "https://example.com" - browse to this URL
	 *  - "https://example.com" - browse to this URL
	 *  - "trace:message" - print this message in the FlashDevelop debug pane
	 *  - all other strings will be called as Javascript functions, so a string "hello_world"
	 *  will call the JS function "hello_world(index)". It passes in the index of the
	 *  point.
	 */
	public function on_click( $do )
	{
		$tmp = 'on-click';
		$this->$tmp = $do;
	}
}

/**
 * Draw a hollow dot
 */
class hollow_dot extends dot_base
{	
	public function __construct($value=null)
	{
		parent::__construct( 'hollow-dot', $value );
	}
}

/**
 * Draw a star
 */
class star extends dot_base
{
	/**
	 * The constructor, takes an optional $value
	 */
	public function __construct($value=null)
	{
		parent::__construct( 'star', $value );
	}
	
	/**
	 * @param $angle is an integer.
	 */
	public function rotation($angle)
	{
		$this->rotation = $angle;
		return $this;
	}
	
	/**
	 * @param $is_hollow is a boolean.
	 */
	public function hollow($is_hollow)
	{
		$this->hollow = $is_hollow;
	}
}

/**
 * Draw a 'bow tie' shape.
 */
class bow extends dot_base
{
	/**
	 * The constructor, takes an optional $value
	 */
	public function __construct($value=null)
	{
		parent::__construct( 'bow', $value );
	}
	
	/**
	 * Rotate the anchor object.
	 * @param $angle is an integer.
	 */
	public function rotation($angle)
	{
		$this->rotation = $angle;
		return $this;
	}
}

/**
 * An <i><b>n</b></i> sided shape.
 */
class anchor extends dot_base
{
	/**
	 * The constructor, takes an optional $value
	 */
	public function __construct($value=null)
	{
		parent::__construct( 'anchor', $value );
	}
	
	/**
	 * Rotate the anchor object.
	 * @param $angle is an integer.
	 */
	public function rotation($angle)
	{
		$this->rotation = $angle;
		return $this;
	}
	
	/**
	 * @param $sides is an integer. Number of sides this shape has.
	 */
	public function sides($sides)
	{
		$this->sides = $sides;
		return $this;
	}
}

/**
 * A simple dot
 */
class dot extends dot_base
{
	/**
	 * The constructor, takes an optional $value
	 */
	public function __construct($value=null)
	{
		parent::__construct( 'dot', $value );
	}
}

/**
 * A simple dot
 */
class solid_dot extends dot_base
{
	/**
	 * The constructor, takes an optional $value
	 */
	public function __construct($value=null)
	{
		parent::__construct( 'solid-dot', $value );
	}
}