import gear from "bundle-text:css/dist/img/icons/gear.svg";
import close from "bundle-text:css/dist/img/icons/close.svg";

interface BaseIconProps {
  svg: string;
}

const BaseIcon = ({ svg }: BaseIconProps) => (
  <span className="Icon" dangerouslySetInnerHTML={{ __html: svg }} />
);

export const GearIcon = () => <BaseIcon svg={gear} />;
export const CloseIcon = () => <BaseIcon svg={close} />;
