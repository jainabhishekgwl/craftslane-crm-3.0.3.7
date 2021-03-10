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

/* catalog/view/template/common/search.twig */
class __TwigTemplate_66b6ed6d40600ea380779c4ed61af9b46b6015f60ec18dffb65ebdad32acf370 extends Template
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
        echo "<div id=\"search\" class=\"input-group mb-3\">
  <input type=\"text\" name=\"search\" value=\"";
        // line 2
        echo ($context["search"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_search"] ?? null);
        echo "\" class=\"form-control form-control-lg\">
  <div class=\"input-group-append\">
    <button type=\"button\" data-lang=\"";
        // line 4
        echo ($context["language"] ?? null);
        echo "\" class=\"btn btn-light btn-lg\"><i class=\"fas fa-search\"></i></button>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "catalog/view/template/common/search.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/view/template/common/search.twig", "C:\\xampp_8.0\\htdocs\\craftslane-crm-3.0.3.7\\upload\\catalog\\view\\template\\common\\search.twig");
    }
}
