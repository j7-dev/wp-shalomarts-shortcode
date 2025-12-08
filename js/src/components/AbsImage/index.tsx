import React, { FC } from 'react'
import { MAP_DATA } from '@/utils'
import { useAtomValue } from 'jotai'
import { selectedDataAtom } from '@/pages/atom';

export const AbsImage: FC<{
	className: string,
	width: number,
	top: number,
	left: number,
}> = ({
	className,
	width = 20,
	top = 0,
	left = 0,
}) => {
		const maps = MAP_DATA.filter(item => item.building === className) || []
		const includeIds = maps.map(item => item.postId)
		const selectedData = useAtomValue(selectedDataAtom);
		const isImageSelected = !!selectedData.postId && includeIds.includes(selectedData.postId) && (selectedData.selectAllIcons || selectedData.building === className);

		return (
			<div className={`sh-abs-image ${className} ${isImageSelected ? 'sh-hovered' : ''}`} style={{
				width: `${width}%`,
				top: `${top}%`,
				left: `${left}%`,
			}}>
			</div>
		)
	}
