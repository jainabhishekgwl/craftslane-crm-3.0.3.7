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

/* install/view/template/common/footer.twig */
class __TwigTemplate_bc13cc26c0ae134d8f2f43fcd5ca7d3125ebaafe8fcda7474be5aa739db800f3 extends Template
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
        echo "<footer class=\"pb-4\">
  <div class=\"container text-center\">
    <a href=\"https://www.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 3
        echo ($context["text_project"] ?? null);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"http://docs.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        echo ($context["text_documentation"] ?? null);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        echo ($context["text_support"] ?? null);
        echo "</a>
    <br>
    ";
        // line 5
        echo ($context["text_footer"] ?? null);
        echo "
  </div>
</footer>
</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "install/view/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 5,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/view/template/common/footer.twig", "C:\\xampp_8.0\\htdocs\\craftslane-crm-3.0.3.7\\upload\\install\\view\\template\\common\\footer.twig");
    }
}
