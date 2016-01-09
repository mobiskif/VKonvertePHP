<?php
class View extends classVisible {
	public function include_Content() {
		if (isset ( $this->context->action )) {
			if (! $this->context->action->include_Content ())
				$this->context->state->include_Content ();
		} else
			$this->context->state->include_Content ();
	}
}
?>