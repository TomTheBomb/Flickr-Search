<?php
/**
 * DboMockSource
 *
 * Mock database connection so no database connection required
 */

class DboMockSource extends DataSource {

    function connect() {
        $this->connected = true;
        return $this->connected;
    }
    function disconnect() {
        $this->connected = false;
        return $this->connected;
    }
		
}
