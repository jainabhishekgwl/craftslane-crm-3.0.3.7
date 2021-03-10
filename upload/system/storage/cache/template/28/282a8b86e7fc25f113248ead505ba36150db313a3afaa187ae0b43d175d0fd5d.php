<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* catalog/view/template/common/header.twig */
class __TwigTemplate_9696d8ccfc380f76b163c29da285866b5cbd261b3d3d801c5fe065f9bb6f4264 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <title>";
        // line 7
        echo ($context["title"] ?? null);
        echo "</title>
  <base href=\"";
        // line 8
        echo ($context["base"] ?? null);
        echo "\"/>
  ";
        // line 9
        if (($context["description"] ?? null)) {
            // line 10
            echo "    <meta name=\"description\" content=\"";
            echo ($context["description"] ?? null);
            echo "\"/>
  ";
        }
        // line 12
        echo "  ";
        if (($context["keywords"] ?? null)) {
            // line 13
            echo "    <meta name=\"keywords\" content=\"";
            echo ($context["keywords"] ?? null);
            echo "\"/>
  ";
        }
        // line 15
        echo "  <script src=\"";
        echo ($context["jquery"] ?? null);
        echo "\" type=\"text/javascript\"></script>
  <link href=\"";
        // line 16
        echo ($context["bootstrap_css"] ?? null);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\"/>
  <script src=\"";
        // line 17
        echo ($context["bootstrap_js"] ?? null);
        echo "\" type=\"text/javascript\"></script>
  <link href=\"";
        // line 18
        echo ($context["icons"] ?? null);
        echo "\" type=\"text/css\" rel=\"stylesheet\"/>
  <link href=\"";
        // line 19
        echo ($context["fonts"] ?? null);
        echo "\" type=\"text/css\" rel=\"stylesheet\"/>
  <link href=\"";
        // line 20
        echo ($context["stylesheet"] ?? null);
        echo "\" type=\"text/css\" rel=\"stylesheet\"/>
  ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 22
            echo "    <link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 22);
            echo "\" type=\"text/css\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 22);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 22);
            echo "\"/>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 25
            echo "    <script src=\"";
            echo $context["script"];
            echo "\" type=\"text/javascript\"></script>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "  <script src=\"catalog/view/javascript/common.js\" type=\"text/javascript\"></script>
  ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 29
            echo "    <link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 29);
            echo "\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 29);
            echo "\"/>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 32
            echo "    ";
            echo $context["analytic"];
            echo "
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['analytic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "</head>
<body>
<div id=\"toast-container\">
  <div class=\"container\">
    <div id=\"toast\"></div>
  </div>
</div>
<nav id=\"top\">
  <div class=\"container\">
    <div class=\"nav float-left\">
      <ul class=\"list-inline\">
        <li class=\"list-inline-item\">";
        // line 45
        echo ($context["currency"] ?? null);
        echo "</li>
        <li class=\"list-inline-item\">";
        // line 46
        echo ($context["language"] ?? null);
        echo "</li>
      </ul>
    </div>
    <div class=\"nav float-right\">
      <ul class=\"list-inline\">
        <li class=\"list-inline-item\"><a href=\"";
        // line 51
        echo ($context["contact"] ?? null);
        echo "\"><i class=\"fas fa-phone\"></i></a> <span class=\"d-none d-md-inline\">";
        echo ($context["telephone"] ?? null);
        echo "</span></li>
        <li class=\"list-inline-item\">
          <div class=\"dropdown\">
            <a href=\"";
        // line 54
        echo ($context["account"] ?? null);
        echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fas fa-user\"></i> <span class=\"d-none d-md-inline\">";
        echo ($context["text_account"] ?? null);
        echo "</span> <i class=\"fas fa-caret-down\"></i></a>
            <div class=\"dropdown-menu dropdown-menu-right\">
              ";
        // line 56
        if (($context["logged"] ?? null)) {
            // line 57
            echo "                <a href=\"";
            echo ($context["account"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_account"] ?? null);
            echo "</a>
                <a href=\"";
            // line 58
            echo ($context["order"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_order"] ?? null);
            echo "</a>
                <a href=\"";
            // line 59
            echo ($context["transaction"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_transaction"] ?? null);
            echo "</a>
                <a href=\"";
            // line 60
            echo ($context["download"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_download"] ?? null);
            echo "</a>
                <a href=\"";
            // line 61
            echo ($context["logout"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_logout"] ?? null);
            echo "</a>
              ";
        } else {
            // line 63
            echo "                <a href=\"";
            echo ($context["register"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_register"] ?? null);
            echo "</a>
                <a href=\"";
            // line 64
            echo ($context["login"] ?? null);
            echo "\" class=\"dropdown-item\">";
            echo ($context["text_login"] ?? null);
            echo "</a>
              ";
        }
        // line 66
        echo "            </div>
          </div>
        </li>
        <li class=\"list-inline-item\"><a href=\"";
        // line 69
        echo ($context["wishlist"] ?? null);
        echo "\" id=\"wishlist-total\" title=\"";
        echo ($context["text_wishlist"] ?? null);
        echo "\"><i class=\"fas fa-heart\"></i> <span class=\"d-none d-md-inline\">";
        echo ($context["text_wishlist"] ?? null);
        echo "</span></a></li>
        <li class=\"list-inline-item\"><a href=\"";
        // line 70
        echo ($context["shopping_cart"] ?? null);
        echo "\" title=\"";
        echo ($context["text_shopping_cart"] ?? null);
        echo "\"><i class=\"fas fa-shopping-cart\"></i> <span class=\"d-none d-md-inline\">";
        echo ($context["text_shopping_cart"] ?? null);
        echo "</span></a></li>
        <li class=\"list-inline-item\"><a href=\"";
        // line 71
        echo ($context["checkout"] ?? null);
        echo "\" title=\"";
        echo ($context["text_checkout"] ?? null);
        echo "\"><i class=\"fas fa-share\"></i> <span class=\"d-none d-md-inline\">";
        echo ($context["text_checkout"] ?? null);
        echo "</span></a></li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-3 col-lg-4\">
        <div id=\"logo\">
          ";
        // line 81
        if (($context["logo"] ?? null)) {
            // line 82
            echo "            <a href=\"";
            echo ($context["home"] ?? null);
            echo "\"><img src=\"";
            echo ($context["logo"] ?? null);
            echo "\" title=\"";
            echo ($context["name"] ?? null);
            echo "\" alt=\"";
            echo ($context["name"] ?? null);
            echo "\" class=\"img-fluid\"/></a>
          ";
        } else {
            // line 84
            echo "            <h1><a href=\"";
            echo ($context["home"] ?? null);
            echo "\">";
            echo ($context["name"] ?? null);
            echo "</a></h1>
          ";
        }
        // line 86
        echo "        </div>
      </div>
      <div class=\"col-md-5\">";
        // line 88
        echo ($context["search"] ?? null);
        echo "</div>
      <div class=\"col-md-4 col-lg-3\">";
        // line 89
        echo ($context["cart"] ?? null);
        echo "</div>
    </div>
  </div>
</header>
<main>
  ";
        // line 94
        echo ($context["menu"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "catalog/view/template/common/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  327 => 94,  319 => 89,  315 => 88,  311 => 86,  303 => 84,  291 => 82,  289 => 81,  272 => 71,  264 => 70,  256 => 69,  251 => 66,  244 => 64,  237 => 63,  230 => 61,  224 => 60,  218 => 59,  212 => 58,  205 => 57,  203 => 56,  196 => 54,  188 => 51,  180 => 46,  176 => 45,  163 => 34,  154 => 32,  149 => 31,  138 => 29,  134 => 28,  131 => 27,  122 => 25,  117 => 24,  104 => 22,  100 => 21,  96 => 20,  92 => 19,  88 => 18,  84 => 17,  80 => 16,  75 => 15,  69 => 13,  66 => 12,  60 => 10,  58 => 9,  54 => 8,  50 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/view/template/common/header.twig", "C:\\xampp_8.0\\htdocs\\craftslane-crm-3.0.3.7\\upload\\catalog\\view\\template\\common\\header.twig");
    }
}
