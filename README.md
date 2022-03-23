# Specification pattern

This is a very simple and extensible specification pattern implementation.

For its core API, it is basically a copy-paste of code found in
https://en.wikipedia.org/wiki/Specification_pattern and contains only the bare
minimum code to make it functionnal.

It is intended to be used as a contract, for a DSL in a domain driven designed
application. In business code, one should never use this library classes
directly, but extend it for implementing its own specification.

You can also copy-paste this library content as well in the shared kernel of
your application if you wish have no dependencies on the oustide world, code
is voluntarily kept naive and small.

