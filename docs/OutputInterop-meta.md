# OutputInterop Meta Document

## Introduction

This document describes the process and discussions that lead to the `output-interop` project.
Its goal is to explain the reasons behind each decision.

## Goal

The goal set by `output-interop` is to standardize how frameworks and libraries make use of an
output renderer to render data with templates. 

By standardizing such a behavior, frameworks and libraries using the `output-interop` project
could work with any compatible renderer.

That would allow end users to choose their own renderer based on their own preferences.

It is important to note that currently it is difficult to switch between
output renderers: twig, smart, php, blade, foil-php, to name a few.

Most of the time, one of these renderers is used. The ability to easily
swap out a renderer with another one, and of course rewrite your templates
should be an option available to everyone.

This is why this library focuses on the engine, contexts, and template.

## Interface names 

The interface names have been influenced from [Foil PHP](https://github.com/FoilPHP/Foil), [Slim PHP-View](https://github.com/slimphp/PHP-View), and [Slim Twig-View](https://github.com/slimphp/Twig-View).

## Interface methods

The choice of which methods the interfaces would contain was made based on
my usage of FoilPHP and Slim PHP-View.

The ability to easily swap out renderers was considered a beneficial side effect.